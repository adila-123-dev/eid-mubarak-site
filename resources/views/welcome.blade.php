<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>🌙 Eid Mubarak! — Tap to Celebrate!</title>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}

:root{
  --sky1:#0f0c29;--sky2:#302b63;--sky3:#24243e;
  --gold:#FFD700;--gold2:#FFA500;
  --mint:#00E5B0;--pink:#FF6B9D;--peach:#FF9A6C;
  --lilac:#C084FC;--white:#FFFBF0;
  --card:#1e1b4b;
}

body{
  font-family:'Nunito',sans-serif;
  background:linear-gradient(135deg,var(--sky1),var(--sky2),var(--sky3));
  min-height:100vh;overflow-x:hidden;
  cursor:none;
}
/* ELEGANT EID INTRO */
.eid-intro{
  text-align:center;
  max-width:700px;
  margin-top:0.5rem;
  animation:fadeUp 0.8s ease forwards;
}

.moon-icon{
  font-size:3rem;
  margin-bottom:0.8rem;
  filter:drop-shadow(0 0 20px rgba(255,215,0,0.5));
  animation:floatMoon 4s ease-in-out infinite;
}

@keyframes floatMoon{
  0%,100%{
    transform:translateY(0px);
  }
  50%{
    transform:translateY(-8px);
  }
}

.intro-line{
  font-family:'Fredoka One',cursive;
  font-size:clamp(1.2rem,3vw,1.8rem);
  background:linear-gradient(135deg,#FFD700,#FF9A6C,#C084FC);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.7rem;
}

.intro-sub{
  color:rgba(255,251,240,0.72);
  font-size:1rem;
  line-height:1.8;
  letter-spacing:0.4px;
}
/* CUSTOM CURSOR */
#cursor{
  width:20px;height:20px;border-radius:50%;
  background:radial-gradient(circle,#FFD700,#FFA500);
  position:fixed;z-index:9999;pointer-events:none;
  transform:translate(-50%,-50%);
  transition:transform 0.1s;
  box-shadow:0 0 12px #FFD700,0 0 24px rgba(255,215,0,0.4);
}
#cursor-trail{
  width:8px;height:8px;border-radius:50%;
  background:#FF6B9D;opacity:0.6;
  position:fixed;z-index:9998;pointer-events:none;
  transform:translate(-50%,-50%);
  transition:all 0.18s ease;
}

/* BACKGROUND CANVAS */
#bg-canvas{
  position:fixed;inset:0;z-index:0;
  pointer-events:none;
}

/* FLOATING EMOJIS */
.float-emoji{
  position:fixed;font-size:2rem;
  pointer-events:none;z-index:1;
  animation:floatUp linear forwards;
}
@keyframes floatUp{
  0%{transform:translateY(0) rotate(0deg);opacity:1}
  100%{transform:translateY(-110vh) rotate(720deg);opacity:0}
}

/* CLICK BURST */
.burst{
  position:fixed;pointer-events:none;z-index:9997;
  font-size:1.6rem;
  animation:burst 0.7s ease forwards;
  transform:translate(-50%,-50%);
}
@keyframes burst{
  0%{transform:translate(-50%,-50%) scale(0);opacity:1}
  60%{transform:translate(-50%,-50%) scale(1.4);opacity:1}
  100%{transform:translate(-50%,-50%) scale(2);opacity:0}
}

/* MAIN LAYOUT */
.page{
  position:relative;z-index:2;
  min-height:100vh;
  display:flex;flex-direction:column;align-items:center;
  padding:2rem 1rem 5rem;
  gap:2rem;
}

/* HEADER BADGE */
.live-badge{
  background:rgba(255,107,157,0.15);
  border:1.5px solid #FF6B9D;
  border-radius:999px;
  padding:0.4rem 1.2rem;
  font-size:0.8rem;font-weight:700;
  color:#FF6B9D;letter-spacing:0.1em;
  display:flex;align-items:center;gap:6px;
  backdrop-filter:blur(8px);
  animation:fadeDown 0.6s ease forwards;
}
.live-dot{
  width:8px;height:8px;border-radius:50%;
  background:#FF6B9D;
  animation:blink 1s ease-in-out infinite;
}

/* BLESSING SECTION */
.blessing-box{
  max-width:680px;
  width:100%;
  text-align:center;

  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(18px);

  border:1.5px solid rgba(255,215,0,0.18);

  border-radius:30px;

  padding:2.5rem 2rem;

  position:relative;
  overflow:hidden;
}

.blessing-box::before{
  content:'';
  position:absolute;
  inset:0;

  background:
    radial-gradient(circle at top right,
    rgba(255,215,0,0.08),
    transparent 35%),

    radial-gradient(circle at bottom left,
    rgba(192,132,252,0.08),
    transparent 35%);

  pointer-events:none;
}

.blessing-stars{
  font-size:1.5rem;
  margin-bottom:1rem;

  animation:floatMoon 4s ease-in-out infinite;
}

.blessing-title{
  font-family:'Fredoka One',cursive;

  font-size:clamp(1.6rem,4vw,2.3rem);

  background:linear-gradient(
    135deg,
    #FFD700,
    #FF9A6C,
    #C084FC
  );

  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;

  margin-bottom:1rem;
}

.blessing-text{
  color:rgba(255,251,240,0.78);

  font-size:1rem;

  line-height:1.9;

  max-width:520px;

  margin:0 auto 1.4rem;
}

.blessing-dua{
  color:#FFD700;

  font-size:1.6rem;

  letter-spacing:1px;

  text-shadow:0 0 15px rgba(255,215,0,0.4);
}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0.2}}
@keyframes fadeDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)}}

/* HERO CARD */
.hero{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(20px);
  border:2px solid rgba(255,215,0,0.3);
  border-radius:32px;
  max-width:680px;width:100%;
  padding:clamp(2rem,6vw,3.5rem);
  text-align:center;
  position:relative;
  overflow:hidden;
  animation:popIn 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.2s both;
}
@keyframes popIn{
  from{opacity:0;transform:scale(0.7) translateY(30px)}
  to{opacity:1;transform:scale(1) translateY(0)}
}
.hero::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 30% 20%,rgba(255,215,0,0.07),transparent 60%),
             radial-gradient(circle at 80% 80%,rgba(192,132,252,0.07),transparent 60%);
  pointer-events:none;
}

/* BIG TITLE */
.eid-label{
  font-size:clamp(0.75rem,2vw,0.9rem);
  font-weight:800;letter-spacing:0.3em;
  color:var(--mint);
  text-transform:uppercase;
  margin-bottom:0.5rem;
  opacity:0;animation:fadeUp 0.5s 0.6s ease forwards;
}
.eid-main{
  font-family:'Fredoka One',cursive;
  font-size:clamp(3rem,10vw,5.5rem);
  line-height:1;
  background:linear-gradient(135deg,#FFD700,#FFA500,#FF6B9D,#C084FC);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  background-clip:text;
  filter:drop-shadow(0 0 30px rgba(255,215,0,0.3));
  opacity:0;animation:fadeUp 0.6s 0.7s ease forwards;
}
.eid-sub{
  font-family:'Fredoka One',cursive;
  font-size:clamp(1.4rem,4vw,2.2rem);
  color:rgba(255,251,240,0.7);
  margin-top:0.3rem;
  opacity:0;animation:fadeUp 0.5s 0.9s ease forwards;
}
@keyframes fadeUp{
  from{opacity:0;transform:translateY(16px)}
  to{opacity:1;transform:translateY(0)}
}

/* ARABIC */
.arabic{
  font-size:clamp(2rem,6vw,3.2rem);
  color:var(--gold);
  direction:rtl;margin:1rem 0 0.5rem;
  filter:drop-shadow(0 0 20px rgba(255,215,0,0.5));
  opacity:0;animation:fadeUp 0.5s 1.1s ease forwards;
}

/* DIVIDER */
.sparkle-div{
  display:flex;align-items:center;gap:8px;
  margin:1.2rem 0;
  opacity:0;animation:fadeUp 0.5s 1.2s ease forwards;
}
.sparkle-div span{font-size:1.2rem;animation:spin 3s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.sparkle-div hr{flex:1;border:none;height:1.5px;
  background:linear-gradient(to right,transparent,rgba(255,215,0,0.5),transparent)}

/* BOUNCE MESSAGE */
.msg{
  font-size:clamp(0.95rem,2.5vw,1.1rem);
  color:rgba(255,251,240,0.8);
  line-height:1.8;
  opacity:0;animation:fadeUp 0.5s 1.3s ease forwards;
}

/* TAP CTA */
.tap-cta{
  display:inline-block;
  margin-top:1.5rem;
  background:linear-gradient(135deg,#FFD700,#FFA500);
  color:#1e1b4b;
  font-family:'Fredoka One',cursive;
  font-size:1.2rem;
  padding:0.8rem 2.2rem;
  border-radius:999px;border:none;cursor:pointer;
  animation:bobble 2s ease-in-out infinite,fadeUp 0.5s 1.5s ease both;
  box-shadow:0 8px 24px rgba(255,165,0,0.4);
  position:relative;overflow:hidden;
}
.tap-cta::after{
  content:'';position:absolute;inset:0;
  background:rgba(255,255,255,0);
  transition:background 0.2s;
}
.tap-cta:hover::after{background:rgba(255,255,255,0.15)}
@keyframes bobble{
  0%,100%{transform:translateY(0) scale(1)}
  50%{transform:translateY(-6px) scale(1.03)}
}

/* COUNTER STRIP */
.counter-strip{
  display:flex;gap:12px;flex-wrap:wrap;justify-content:center;
  max-width:680px;width:100%;
  opacity:0;animation:fadeUp 0.6s 0.4s ease forwards;
}
.counter-card{
  background:rgba(255,255,255,0.07);
  backdrop-filter:blur(12px);
  border:1.5px solid rgba(255,255,255,0.15);
  border-radius:20px;
  padding:1rem 1.4rem;
  text-align:center;
  flex:1;min-width:110px;
  transition:transform 0.2s,border-color 0.2s;
}
.counter-card:hover{transform:translateY(-4px);border-color:var(--gold)}
.counter-num{
  font-family:'Fredoka One',cursive;
  font-size:2rem;
  background:linear-gradient(135deg,#FFD700,#FF6B9D);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.counter-lbl{font-size:0.72rem;font-weight:700;letter-spacing:0.1em;color:rgba(255,251,240,0.5);text-transform:uppercase;margin-top:2px}

/* VISITORS SECTION */
.section-title{
  font-family:'Fredoka One',cursive;
  font-size:1.6rem;color:var(--white);
  display:flex;align-items:center;gap:8px;
}

.visitors-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
  gap:10px;max-width:680px;width:100%;
  max-height:360px;overflow-y:auto;
  padding-right:4px;
}
.visitors-grid::-webkit-scrollbar{width:4px}
.visitors-grid::-webkit-scrollbar-track{background:rgba(255,255,255,0.05);border-radius:4px}
.visitors-grid::-webkit-scrollbar-thumb{background:rgba(255,215,0,0.4);border-radius:4px}

.visitor-pill{
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.12);
  border-radius:14px;
  padding:10px 14px;
  display:flex;align-items:center;gap:10px;
  animation:slideIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both;
}
@keyframes slideIn{
  from{opacity:0;transform:scale(0.8) translateY(10px)}
  to{opacity:1;transform:scale(1) translateY(0)}
}
.visitor-flag{font-size:1.5rem;flex-shrink:0}
.visitor-info{overflow:hidden}
.visitor-loc{font-weight:700;font-size:0.85rem;color:var(--white);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.visitor-time{font-size:0.7rem;color:rgba(255,251,240,0.45);margin-top:1px}

/* WISH GAME */
.wish-game{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(20px);
  border:2px solid rgba(192,132,252,0.4);
  border-radius:28px;
  max-width:680px;width:100%;
  padding:2rem;
}
.game-title{
  font-family:'Fredoka One',cursive;
  font-size:1.4rem;color:var(--lilac);
  margin-bottom:0.8rem;text-align:center;
}
.game-desc{font-size:0.88rem;color:rgba(255,251,240,0.6);text-align:center;margin-bottom:1.2rem}

.input-row{display:flex;gap:8px;flex-wrap:wrap}
.wish-input{
  flex:1;min-width:140px;
  background:rgba(255,255,255,0.08);
  border:1.5px solid rgba(255,255,255,0.2);
  border-radius:12px;
  color:var(--white);
  font-family:'Nunito',sans-serif;
  font-size:0.95rem;font-weight:600;
  padding:0.7rem 1rem;outline:none;
  transition:border-color 0.2s,box-shadow 0.2s;
}
.wish-input::placeholder{color:rgba(255,251,240,0.3)}
.wish-input:focus{border-color:var(--lilac);box-shadow:0 0 0 3px rgba(192,132,252,0.2)}

.wish-btn{
  background:linear-gradient(135deg,var(--lilac),#7C3AED);
  color:#fff;border:none;border-radius:12px;
  font-family:'Fredoka One',cursive;
  font-size:1rem;padding:0.7rem 1.4rem;
  cursor:pointer;transition:transform 0.15s,box-shadow 0.15s;
  box-shadow:0 4px 14px rgba(124,58,237,0.4);
}
.wish-btn:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(124,58,237,0.5)}
.wish-btn:active{transform:scale(0.96)}

.wish-result{
  margin-top:1rem;min-height:2.5rem;
  font-family:'Fredoka One',cursive;
  font-size:1.15rem;color:var(--gold);
  text-align:center;
  transition:all 0.3s;
}

/* SHARE SECTION */
.share-box{
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(12px);
  border:1.5px solid rgba(0,229,176,0.3);
  border-radius:24px;
  max-width:680px;width:100%;
  padding:1.6rem 2rem;
  text-align:center;
}
/* MAGICAL ACTIONS */
.magic-actions{
  max-width:700px;
  width:100%;

  text-align:center;

  background:rgba(255,255,255,0.05);

  backdrop-filter:blur(18px);

  border:1.5px solid rgba(255,215,0,0.15);

  border-radius:32px;

  padding:2.3rem 1.5rem;

  position:relative;
  overflow:hidden;
}

.magic-actions::before{
  content:'';

  position:absolute;
  inset:0;

  background:
  radial-gradient(circle at top right,
  rgba(255,215,0,0.08),
  transparent 35%),

  radial-gradient(circle at bottom left,
  rgba(192,132,252,0.08),
  transparent 35%);

  pointer-events:none;
}

.magic-title{
  font-family:'Fredoka One',cursive;

  font-size:1.4rem;

  margin-bottom:1.6rem;

  background:linear-gradient(
    135deg,
    #FFD700,
    #FF9A6C,
    #C084FC
  );

  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.magic-orbs{
  display:flex;

  justify-content:center;

  gap:18px;

  flex-wrap:wrap;
}

.orb{
  width:90px;
  height:90px;

  border-radius:50%;

  border:none;

  cursor:pointer;

  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;

  gap:4px;

  transition:
    transform .25s ease,
    box-shadow .25s ease;

  color:white;

  position:relative;
}

.orb span{
  font-size:1.8rem;
}

.orb small{
  font-size:.72rem;
  font-weight:700;
  letter-spacing:.5px;
}

.orb:hover{
  transform:translateY(-8px) scale(1.08);
}

/* WHATSAPP */
.orb-wa{
  background:linear-gradient(135deg,#25D366,#119c4f);

  box-shadow:
    0 0 20px rgba(37,211,102,0.45);
}

/* TWITTER */
.orb-tw{
  background:linear-gradient(135deg,#1DA1F2,#2563EB);

  box-shadow:
    0 0 20px rgba(29,161,242,0.45);
}

/* FACEBOOK */
.orb-fb{
  background:linear-gradient(135deg,#4267B2,#5B7FFF);

  box-shadow:
    0 0 20px rgba(66,103,178,0.45);
}

/* COPY */
.orb-copy{
  background:linear-gradient(135deg,#FFD700,#FF9A6C);

  color:#1e1b4b;

  box-shadow:
    0 0 20px rgba(255,215,0,0.45);
}

.magic-text{
  margin-top:1.6rem;

  color:rgba(255,251,240,0.72);

  font-size:.95rem;

  line-height:1.7;
}

@media(max-width:500px){

  .magic-orbs{
    gap:12px;
  }

  .orb{
    width:76px;
    height:76px;
  }

  .orb span{
    font-size:1.5rem;
  }
}

/* EID MAGIC ZONE */
.eid-magic-zone{
  width:100%;
  max-width:700px;

  text-align:center;

  padding:2rem 1rem 3rem;

  position:relative;
}

.magic-cloud{
  display:inline-block;

  padding:1rem 1.8rem;

  border-radius:999px;

  background:rgba(255,255,255,0.06);

  border:1px solid rgba(255,215,0,0.18);

  color:#FFD700;

  font-weight:700;

  letter-spacing:.5px;

  backdrop-filter:blur(12px);

  margin-bottom:2rem;

  box-shadow:
    0 0 25px rgba(255,215,0,0.08);
}

/* FLOATING ICONS */
.floating-icons{
  position:relative;

  height:180px;

  margin-bottom:1rem;
}

.float-balloon{
  position:absolute;

  width:72px;
  height:72px;

  border-radius:50%;

  display:flex;
  align-items:center;
  justify-content:center;

  font-size:2rem;

  background:rgba(255,255,255,0.08);

  backdrop-filter:blur(12px);

  border:1px solid rgba(255,255,255,0.1);

  animation:floaty 5s ease-in-out infinite;

  box-shadow:
    0 0 25px rgba(255,255,255,0.06);
}

@keyframes floaty{
  0%,100%{
    transform:translateY(0px);
  }
  50%{
    transform:translateY(-18px);
  }
}

.b1{
  left:5%;
  top:40px;
  animation-delay:0s;
}

.b2{
  left:22%;
  top:0px;
  animation-delay:1s;
}

.b3{
  left:40%;
  top:50px;
  animation-delay:2s;
}

.b4{
  right:22%;
  top:10px;
  animation-delay:1.5s;
}

.b5{
  right:5%;
  top:55px;
  animation-delay:.5s;
}
/* FULL SCREEN BLOOM */
.eid-bloom{
  position:fixed;
  inset:0;

  pointer-events:none;

  z-index:9996;

  background:radial-gradient(
    circle,
    rgba(255,215,0,0.28) 0%,
    rgba(255,154,108,0.14) 30%,
    rgba(192,132,252,0.08) 55%,
    transparent 75%
  );

  animation:bloomFade 1.5s ease forwards;
}

@keyframes bloomFade{
  0%{
    opacity:0;
    transform:scale(.4);
  }

  30%{
    opacity:1;
  }

  100%{
    opacity:0;
    transform:scale(2.4);
  }
}

/* RIPPLE */
.eid-ripple{
  position:fixed;

  width:40px;
  height:40px;

  border-radius:50%;

  border:2px solid rgba(255,215,0,0.6);

  pointer-events:none;

  z-index:9997;

  transform:translate(-50%,-50%);

  animation:rippleExpand 1s ease-out forwards;
}

@keyframes rippleExpand{

  from{
    width:20px;
    height:20px;
    opacity:1;
  }

  to{
    width:700px;
    height:700px;
    opacity:0;
  }
}
@keyframes flashFade{

  0%{
    opacity:0;
  }

  30%{
    opacity:1;
  }

  100%{
    opacity:0;
  }
}

/* MAGIC PARTICLES */
.magic-particle{
  position:fixed;

  pointer-events:none;

  z-index:9998;

  font-size:2rem;

  animation:magicFly 2.8s ease-out forwards;
}

@keyframes magicFly{

  0%{
    opacity:1;
    transform:
      translate(0,0)
      scale(.5)
      rotate(0deg);
  }

  100%{
    opacity:0;
    transform:
      translate(var(--x),var(--y))
      scale(1.6)
      rotate(360deg);
  }
}

.b6{
  left:50%;
  top:110px;
  transform:translateX(-50%);
  animation-delay:2.5s;
}

/* DUA */
.eid-dua{
  color:rgba(255,251,240,0.72);

  font-size:1rem;

  line-height:1.8;

  margin-top:1rem;

  letter-spacing:.4px;
}

@media(max-width:600px){

  .floating-icons{
    height:220px;
  }

  .float-balloon{
    width:58px;
    height:58px;

    font-size:1.5rem;
  }
}
.share-label{
  font-size:0.78rem;font-weight:700;letter-spacing:0.15em;
  color:var(--mint);text-transform:uppercase;margin-bottom:1rem;
}
.share-btns{display:flex;gap:8px;justify-content:center;flex-wrap:wrap}
.sbtn{
  border:1.5px solid;border-radius:12px;
  font-family:'Nunito',sans-serif;font-weight:700;
  font-size:0.85rem;padding:0.55rem 1.1rem;
  cursor:pointer;background:transparent;
  transition:all 0.2s;
}
.sbtn-wa{border-color:#25D366;color:#25D366}
.sbtn-wa:hover{background:#25D366;color:#fff}
.sbtn-tw{border-color:#1DA1F2;color:#1DA1F2}
.sbtn-tw:hover{background:#1DA1F2;color:#fff}
.sbtn-cp{border-color:var(--gold);color:var(--gold)}
.sbtn-cp:hover{background:var(--gold);color:#1e1b4b}
.sbtn-fb{border-color:#4267B2;color:#4267B2}
.sbtn-fb:hover{background:#4267B2;color:#fff}

/* FOOTER */
footer{
  font-size:0.75rem;font-weight:600;letter-spacing:0.12em;
  color:rgba(255,251,240,0.3);text-align:center;
  padding-bottom:2rem;
}

/* FIREWORK canvas */
#fw-canvas{position:fixed;inset:0;z-index:5;pointer-events:none}

/* RESPONSIVE */
@media(max-width:480px){
  .hero{padding:1.6rem 1.2rem;border-radius:22px}
  .wish-game,.share-box{padding:1.2rem}
}
</style>
</head>
<body>
<canvas id="bg-canvas"></canvas>
<canvas id="fw-canvas"></canvas>
<div id="cursor"></div>
<div id="cursor-trail"></div>

<div class="page">

  <!-- Live badge -->
 <!-- Elegant Eid Intro -->
<div class="eid-intro">

  <div class="moon-icon">🌙</div>

  <div class="intro-line">
    Eid is a time of gratitude, peace & togetherness
  </div>

  <div class="intro-sub">
    May your home be filled with warmth, laughter,
    and countless beautiful memories ✨
  </div>

</div>

  <!-- Counter strip -->
  

  <!-- Hero card -->
  <div class="hero" id="hero-card">
    <div class="eid-label">✨ wishing you a joyful ✨</div>
    <div class="eid-main">Eid Mubarak!</div>
    <div class="eid-sub">عيد الفطر المبارك</div>
    <div class="arabic">عيد مبارك</div>

    <div class="sparkle-div">
      <hr><span>🌙</span><hr>
    </div>

    <p class="msg">
      May this Eid bring <strong style="color:#FFD700">overflowing joy</strong>, warm hugs,<br>
      sweet treats, and blessings that never run out! 🎊
    </p>

    <button class="tap-cta" id="tap-btn" onclick="celebrate(event)">
      🎉 Tap to Celebrate!
    </button>
  </div>

  <!-- Visitors section -->
<!-- Blessings Section -->
<div class="blessing-box">

  <div class="blessing-stars">
    ✨ 🌙 ✨
  </div>

  <h2 class="blessing-title">
    Eid Wishes Across Hearts
  </h2>

  <p class="blessing-text">
    Tonight is filled with prayers, smiles,
    warm hearts and beautiful moments shared
    with the people we love most 💛
  </p>

  <div class="blessing-dua">
    ﷽ تقبل الله منا ومنكم
  </div>

</div>

  <!-- Wish game -->
  <div class="wish-game">
    <div class="game-title">🎁 Send a Surprise Wish</div>
    <p class="game-desc">Type a name — get a magical Eid blessing just for them!</p>
    <div class="input-row">
      <input class="wish-input" id="wish-name" type="text" placeholder="Friend's name…" maxlength="30">
      <button class="wish-btn" onclick="sendWish()">✨ Wish!</button>
    </div>
    <div class="wish-result" id="wish-result"></div>
  </div>

  <!-- Share box -->
 <!-- Floating Eid Magic -->
<div class="eid-magic-zone">

  <div class="magic-cloud" onclick="eidBloom(event)">Tap here to see the magic....

  <div class="floating-icons">

    <div class="float-balloon b1">🌙</div>
    <div class="float-balloon b2">⭐</div>
    <div class="float-balloon b3">🕌</div>
    <div class="float-balloon b4">🎉</div>
    <div class="float-balloon b5">💛</div>
    <div class="float-balloon b6">✨</div>

  </div>

  <div class="eid-dua">
    May your Eid shine brighter than the stars tonight 🌌
  </div>

</div>
<script>
// ── CURSOR ──
const cur = document.getElementById('cursor');
const trail = document.getElementById('cursor-trail');
let mx=0,my=0,tx=0,ty=0;
document.addEventListener('mousemove',e=>{
  mx=e.clientX;my=e.clientY;
  cur.style.left=mx+'px';cur.style.top=my+'px';
});
setInterval(()=>{
  tx+=(mx-tx)*0.15;ty+=(my-ty)*0.15;
  trail.style.left=tx+'px';trail.style.top=ty+'px';
},16);

// ── STARFIELD ──
(function(){
  const cv=document.getElementById('bg-canvas');
  const ctx=cv.getContext('2d');
  let stars=[];
  function resize(){cv.width=innerWidth;cv.height=innerHeight}
  function init(){
    stars=[];
    for(let i=0;i<Math.floor(innerWidth*innerHeight/2500);i++){
      stars.push({x:Math.random()*cv.width,y:Math.random()*cv.height,
        r:Math.random()*1.6+0.2,a:Math.random()*Math.PI*2,
        s:Math.random()*0.006+0.002});
    }
  }
  function draw(){
    ctx.clearRect(0,0,cv.width,cv.height);
    stars.forEach(s=>{
      s.a+=s.s;
      const alpha=(Math.sin(s.a)+1)/2*0.9+0.05;
      ctx.beginPath();ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
      ctx.fillStyle=`rgba(255,245,210,${alpha})`;ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  window.addEventListener('resize',()=>{resize();init()});
  resize();init();draw();
})();

// ── FIREWORKS ──
const fwCv=document.getElementById('fw-canvas');
const fwCtx=fwCv.getContext('2d');
fwCv.width=innerWidth;fwCv.height=innerHeight;
window.addEventListener('resize',()=>{fwCv.width=innerWidth;fwCv.height=innerHeight});
let particles=[];
function explode(x,y,colors){
  for(let i=0;i<35;i++){
    const ang=Math.random()*Math.PI*2;
    const spd=Math.random()*5+2;
    particles.push({
      x,y,vx:Math.cos(ang)*spd,vy:Math.sin(ang)*spd,
      color:colors[Math.floor(Math.random()*colors.length)],
      life:1,decay:Math.random()*0.02+0.015,r:Math.random()*3+1
    });
  }
}
function animFW(){
  fwCtx.clearRect(0,0,fwCv.width,fwCv.height);
  particles=particles.filter(p=>p.life>0);
  particles.forEach(p=>{
    p.x+=p.vx;p.y+=p.vy;p.vy+=0.08;p.life-=p.decay;
    fwCtx.save();fwCtx.globalAlpha=p.life;
    fwCtx.beginPath();fwCtx.arc(p.x,p.y,p.r,0,Math.PI*2);
    fwCtx.fillStyle=p.color;fwCtx.fill();fwCtx.restore();
  });
  requestAnimationFrame(animFW);
}
animFW();

let tapCount=0;
const burstEmojis=['🌙','⭐','✨','🎉','🎊','💛','🌟','🕌','🎁','🌺','❤️','🎈'];
const burstColors=[
  ['#FFD700','#FFA500','#FFFFFF'],
  ['#FF6B9D','#C084FC','#FFD700'],
  ['#00E5B0','#FFD700','#FFFFFF'],
  ['#FF9A6C','#FF6B9D','#C084FC'],
];

function celebrate(e){

  const btn = document.getElementById('tap-btn');

  /* BUTTON MAGIC */
  btn.style.transform = 'scale(0.92) rotate(-2deg)';

  setTimeout(()=>{
    btn.style.transform = '';
  },180);

  /* SCREEN SHAKE */
  document.body.animate([
    { transform:'translateX(0px)' },
    { transform:'translateX(-4px)' },
    { transform:'translateX(4px)' },
    { transform:'translateX(-2px)' },
    { transform:'translateX(0px)' }
  ],{
    duration:400
  });

  /* HERO GLOW */
  const hero = document.getElementById('hero-card');

  hero.animate([
    {
      boxShadow:'0 0 0 rgba(255,215,0,0)'
    },
    {
      boxShadow:'0 0 80px rgba(255,215,0,0.8)'
    },
    {
      boxShadow:'0 0 0 rgba(255,215,0,0)'
    }
  ],{
    duration:1200
  });

  /* GOLDEN FLASH */
  const flash = document.createElement('div');

  flash.style.position = 'fixed';
  flash.style.inset = '0';
  flash.style.zIndex = '9999';
  flash.style.pointerEvents = 'none';

  flash.style.background =
    'radial-gradient(circle, rgba(255,215,0,0.35), transparent 70%)';

  flash.style.animation = 'flashFade 1s ease forwards';

  document.body.appendChild(flash);

  setTimeout(()=>{
    flash.remove();
  },1000);

  /* MASSIVE FIREWORKS */
  const colors = [
    '#FFD700',
    '#FF6B9D',
    '#C084FC',
    '#00E5B0',
    '#FF9A6C',
    '#FFFFFF'
  ];

  explode(innerWidth*0.3, innerHeight*0.3, colors);

  setTimeout(()=>{
    explode(innerWidth*0.7, innerHeight*0.25, colors);
  },200);

  setTimeout(()=>{
    explode(innerWidth*0.5, innerHeight*0.18, colors);
  },400);

  setTimeout(()=>{
    explode(innerWidth*0.4, innerHeight*0.4, colors);
  },600);

  setTimeout(()=>{
    explode(innerWidth*0.6, innerHeight*0.38, colors);
  },800);

  /* FLOATING EID EMOJIS */
  const emojis = [
    '🌙',
    '✨',
    '⭐',
    '🎉',
    '🎊',
    '💛',
    '🕌',
    '🌟',
    '💫',
    '🎁'
  ];

  for(let i=0;i<35;i++){

    const el = document.createElement('div');

    el.className = 'float-emoji';

    el.textContent =
      emojis[Math.floor(Math.random()*emojis.length)];

    el.style.left =
      Math.random()*innerWidth + 'px';

    el.style.top =
      innerHeight*0.7 + 'px';

    el.style.fontSize =
      (1.2 + Math.random()*2.2) + 'rem';

    el.style.animationDuration =
      (2 + Math.random()*3) + 's';

    document.body.appendChild(el);

    setTimeout(()=>{
      el.remove();
    },5000);
  }

  /* TEXT CHANGE MAGIC */
  const msg = document.querySelector('.msg');

  const original = msg.innerHTML;

  msg.innerHTML =
    '🎊 Eid joy unlocked! May your heart shine brighter than the moon tonight 🌙';

  msg.style.color = '#FFD700';

  msg.animate([
    { transform:'scale(0.8)', opacity:0.4 },
    { transform:'scale(1.08)', opacity:1 },
    { transform:'scale(1)', opacity:1 }
  ],{
    duration:700
  });

  setTimeout(()=>{
    msg.innerHTML = original;
    msg.style.color = '';
  },4500);

  /* SEND TO SERVER */
  fetch('/api/tap',{
    method:'POST',
    headers:{
      'Content-Type':'application/json',
      'X-CSRF-TOKEN':
        document.querySelector(
          'meta[name=csrf-token]'
        ).content
    }
  });

}

// Click anywhere to celebrate
document.addEventListener('click',e=>{
  if(e.target.closest('.wish-btn,.wish-input,.sbtn,.tap-cta,.share-box,.wish-game'))return;
  celebrate(e);
});

// ── WISH GENERATOR ──
const wishes=[
  "🌙 May Allah shower you with endless blessings and happiness!",
  "⭐ Wishing you a Eid filled with love, laughter & yummy food!",
  "🎊 May every prayer you make be answered this beautiful Eid!",
  "💛 Sending you the warmest Eid hugs across the miles!",
  "🌺 May your heart always be as light as Eid morning feels!",
  "✨ This Eid, may all your dreams begin to come true!",
  "🎁 May joy, health & peace be your gifts this blessed Eid!",
  "🌟 Eid wouldn't be as bright without amazing people like you!",
];
let wishCount=0;

function sendWish(){
  const name=document.getElementById('wish-name').value.trim();
  const out=document.getElementById('wish-result');
  if(!name){out.textContent='👆 Enter a name first!';return;}
  const w=wishes[Math.floor(Math.random()*wishes.length)];
  out.style.opacity=0;
  setTimeout(()=>{out.textContent=`${name} — ${w}`;out.style.opacity=1;},180);
  wishCount++;
  document.getElementById('cnt-wishes').textContent=wishCount;
  explode(innerWidth/2,innerHeight/2,['#FFD700','#C084FC','#FF6B9D','#00E5B0']);
  // emit floats
  for(let i=0;i<5;i++){
    const el=document.createElement('div');
    el.className='float-emoji';
    el.textContent=burstEmojis[Math.floor(Math.random()*burstEmojis.length)];
    el.style.left=Math.random()*innerWidth+'px';
    el.style.top=innerHeight*0.7+'px';
    el.style.animationDuration=(3+Math.random()*2)+'s';
    document.body.appendChild(el);
    setTimeout(()=>el.remove(),5000);
  }
  fetch('/api/wish',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({name})});
}
document.getElementById('wish-name').addEventListener('keydown',e=>{if(e.key==='Enter')sendWish()});

// ── SHARE ──
const shareMsg=encodeURIComponent('Eid Mubarak! 🌙✨ Sending you joy, peace & Allah\'s endless blessings this Eid. عيد مبارك — '+location.href);
function shareWA(){window.open('https://wa.me/?text='+shareMsg,'_blank')}
function shareTW(){window.open('https://twitter.com/intent/tweet?text='+shareMsg,'_blank')}
function shareFB(){window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'_blank')}
function copyLink(){
  navigator.clipboard.writeText(location.href).then(()=>{
    const b=document.getElementById('copy-btn');
    b.textContent='✅ Copied!';
    setTimeout(()=>b.textContent='🔗 Copy Link',2000);
  });
}

// ── VISITOR DATA FROM SERVER ──
const grid=document.getElementById('visitors-grid');
const flagMap={'IN':'🇮🇳','US':'🇺🇸','GB':'🇬🇧','PK':'🇵🇰','BD':'🇧🇩','SA':'🇸🇦','AE':'🇦🇪','MY':'🇲🇾','ID':'🇮🇩','NG':'🇳🇬','EG':'🇪🇬','TR':'🇹🇷','DE':'🇩🇪','FR':'🇫🇷','CA':'🇨🇦','AU':'🇦🇺','other':'🌍'};
function timeAgo(ts){
  const s=Math.floor((Date.now()-new Date(ts))/1000);
  if(s<60)return 'just now';
  if(s<3600)return Math.floor(s/60)+'m ago';
  return Math.floor(s/3600)+'h ago';
}





// ── AUTO FIREWORKS on load ──
setTimeout(()=>{
  const colors=['#FFD700','#FF6B9D','#00E5B0','#C084FC','#FF9A6C'];
  explode(innerWidth*0.3,innerHeight*0.3,colors);
  setTimeout(()=>explode(innerWidth*0.7,innerHeight*0.25,colors),300);
  setTimeout(()=>explode(innerWidth*0.5,innerHeight*0.2,colors),600);
},800);

function eidBloom(e){

  const x = e.clientX;
  const y = e.clientY;

  /* SCREEN BLOOM */
  const bloom = document.createElement('div');
  bloom.className = 'eid-bloom';

  document.body.appendChild(bloom);

  setTimeout(()=>{
    bloom.remove();
  },1500);

  /* RIPPLE */
  const ripple = document.createElement('div');

  ripple.className = 'eid-ripple';

  ripple.style.left = x + 'px';
  ripple.style.top = y + 'px';

  document.body.appendChild(ripple);

  setTimeout(()=>{
    ripple.remove();
  },1000);

  /* PARTICLES */
  const particles = [
    '🌙',
    '✨',
    '⭐',
    '💛',
    '🕌',
    '🎉',
    '🌟',
    '🎊'
  ];

  for(let i=0;i<24;i++){

    const p = document.createElement('div');

    p.className = 'magic-particle';

    p.textContent =
      particles[
        Math.floor(Math.random()*particles.length)
      ];

    p.style.left = x + 'px';
    p.style.top = y + 'px';

    p.style.setProperty(
      '--x',
      (Math.random()*700 - 350) + 'px'
    );

    p.style.setProperty(
      '--y',
      (Math.random()*500 - 250) + 'px'
    );

    document.body.appendChild(p);

    setTimeout(()=>{
      p.remove();
    },2800);
  }

  /* EXTRA FIREWORKS */
  explode(
    x,
    y,
    ['#FFD700','#FF6B9D','#C084FC','#00E5B0']
  );
}

</script>
</body>
</html>
