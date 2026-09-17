{{--
    Logo TokoKita — dipakai Breeze di halaman login/register (guest layout)
    dan di navbar area dashboard (layouts/navigation.blade.php),
    menggantikan logo bawaan Laravel.
--}}
<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 font-bold text-indigo-600']) }}>
    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">TK</span>
    <span>TokoKita</span>
</div>
