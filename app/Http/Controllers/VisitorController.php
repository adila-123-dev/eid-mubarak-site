<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class VisitorController extends Controller
{
    /**
     * Log a visitor and return all visitors.
     * Called on page load automatically.
     */
    public function log(Request $request)
    {
        $ip = $request->ip();

        // Don't double-log same IP within 30 minutes
        $cacheKey = 'visitor_logged_' . md5($ip);
        if (!Cache::has($cacheKey)) {
            $geo = $this->getGeoData($ip);

            Visitor::create([
                'ip'         => $ip,
                'country'    => $geo['country'] ?? 'Unknown',
                'city'       => $geo['city']    ?? 'Unknown',
                'region'     => $geo['region']  ?? null,
                'user_agent' => $request->userAgent(),
                'referer'    => $request->header('referer'),
            ]);

            Cache::put($cacheKey, true, now()->addMinutes(30));
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Return all visitors (newest first, last 500).
     */
    public function index()
    {
        $visitors = Visitor::orderByDesc('created_at')
            ->limit(500)
            ->get(['country', 'city', 'created_at']);

        $stats = [
            'total'     => Visitor::count(),
            'countries' => Visitor::distinct('country')->count('country'),
        ];

        return response()->json([
            'visitors' => $visitors,
            'stats'    => $stats,
        ]);
    }

    /**
     * Record a celebration tap.
     */
    public function tap(Request $request)
    {
        Cache::increment('eid_taps');
        return response()->json(['taps' => Cache::get('eid_taps', 0)]);
    }

    /**
     * Record a wish sent.
     */
    public function wish(Request $request)
    {
        $name = $request->input('name', 'Someone');
        Cache::increment('eid_wishes');
        // Optionally store: \App\Models\Wish::create(['name' => $name]);
        return response()->json(['wishes' => Cache::get('eid_wishes', 0)]);
    }

    /**
     * Use ip-api.com (free, no key needed) for geolocation.
     */
    private function getGeoData(string $ip): array
    {
        // Skip for localhost / private IPs
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.')) {
            return ['country' => 'Local', 'city' => 'Dev Machine', 'region' => null];
        }

        try {
            $resp = Http::timeout(3)->get("http://ip-api.com/json/{$ip}?fields=country,countryCode,regionName,city");
            if ($resp->successful()) {
                $data = $resp->json();
                return [
                    'country' => $data['countryCode'] ?? 'Unknown',
                    'city'    => $data['city']        ?? 'Unknown',
                    'region'  => $data['regionName']  ?? null,
                ];
            }
        } catch (\Exception $e) {
            // Silent fail — geo is non-critical
        }

        return ['country' => 'Unknown', 'city' => 'Unknown', 'region' => null];
    }
}
