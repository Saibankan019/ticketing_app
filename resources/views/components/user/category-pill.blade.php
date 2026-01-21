@props(['active' => false, 'label' => ''])

<style>
    .cyber-pill {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .cyber-pill::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }
    
    .cyber-pill:hover::before {
        transform: translateX(100%);
    }
    
    .cyber-pill-active {
        animation: glow-pulse 2s ease-in-out infinite;
    }
    
    @keyframes glow-pulse {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
        }
        50% { 
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.7);
        }
    }
</style>

<button {{ $attributes->merge([
  'class' => 'cyber-pill px-6 py-2 rounded-full text-sm font-semibold uppercase tracking-wide transition-all duration-300 hover:scale-105 border ' .
    ($active
      ? 'bg-blue-600 text-white border-blue-500 cyber-pill-active'
      : 'bg-gray-800 text-gray-300 border-blue-500/30 hover:bg-blue-500/20 hover:text-white hover:border-blue-500/60')
]) }}>
  <span class="relative z-10">{{ $label }}</span>
</button>