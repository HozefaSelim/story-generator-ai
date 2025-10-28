@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-xl border-2 border-slate-700 bg-slate-800/50 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200']) }}>
