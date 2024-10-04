<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Manage Subscription') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Subscribe, upgrade, downgrade or cancel your subscription.') }}
                    </x-slot>

                    <x-slot name="content">
                        <p>{{ config('app.name') . __(' uses Stripe for billing. You will be taken to Stripe\'s website to manage your subscription.') }}</p>

                        @if (Auth::user()->currentTeam->subscribed('main'))
                            <div class="mt-6">
                                <a class="px-6 py-3 bg-indigo-500 rounded text-white" href="{{ route('billing') }}">
                                    {{ __('Manage Subscription') }}
                                </a>
                            </div>
                        @else
                            <div id="error-message" class="hidden p-2 mt-4 bg-pink-100"></div>
                            <div class="flex items-center gap-2 mt-4">
                                Switch to
                                <label class="inline-flex items-center me-5 cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer" checked>
                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Yearly</span>
                                </label>
                            </div>

                            @forelse(config('billing.plans') as $plan)
                                <div class="mt-4">
                                    <div class="flex flex-col w-full border border-slate-200 rounded-lg shadow-sm divide-y divide-slate-200 relative overflow-hidden">
                                        <div class="p-6">
                                            <h2 class="text-xl leading-6 font-bold text-slate-900 dark:text-white">
                                                {{ $plan['name'] }}</h2>
                                            <p class="mt-2 text-base text-slate-700 leading-tight dark:text-white">
                                                {{ $plan['short_description'] }}</p>
                                            <p class="mt-4">
                                                <span class="text-4xl font-bold text-slate-900 dark:text-white tracking-tighter">$30</span>
                                                <span class="text-base font-medium text-slate-500">/mo</span>
                                            </p>
                                        </div>
                                        <div class="pt-4 pb-8 px-6">
                                            <h3 class="text-sm font-bold text-slate-900 dark:text-gray-300 tracking-wide uppercase">What's included</h3>
                                            <ul role="list" class="mt-4 space-y-3">
                                                @foreach($plan['features'] as $feature)
                                                    <li class="flex space-x-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-5 w-5 text-green-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                        <span class="text-base text-slate-700 dark:text-slate-300">{{ $feature }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="mt-auto py-3 px-4">
                                            <x-button class="" onclick="subscribe('{{ $plan['monthly_id'] }}')">
                                                Subscribe
                                            </x-button>
                                        </div>
                                        @if($plan['yearly_incentive'])
                                            <div class="absolute right-0 top-0 h-16 w-16">
                                                <div
                                                    class="absolute transform rotate-45 bg-green-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px]">
                                                    {{ $plan['yearly_incentive'] }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500">
                                    {{ __('No plans available at this time.') }}
                                </div>
                            @endforelse
                        @endif
                    </x-slot>
                </x-action-section>
             </div>
        </div>
    </div>
</x-app-layout>

<script>
    function subscribe(plan) {
        const error = document.getElementById('error-message');
        error.classList.add('hidden');

        axios.post('/subscribe', {
            plan: plan,
            yearly: document.querySelector('input[type="checkbox"]').checked
        })
        .then(res => {
            if (res.data.status) {
                error.classList.remove('hidden');
                error.innerText = res.data.message;
                window.location.href = res.data.url;
            } else {
                window.location.reload();
            }
        })
        .catch(error => {
            error.classList.remove('hidden');
            error.innerText = error.response.data.message;
        });
    }
</script>
