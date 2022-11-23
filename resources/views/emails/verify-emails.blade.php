<x-mail::message>
    # Verify Your Email Address

    Your order has been shipped!

    <x-mail::button :url="$url">
        Verify Your Email
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
