<x-mail::message>
    # Chào mừng bạn đến với **DAWED News**!

    Cảm ơn bạn đã đăng ký nhận **tin tức giải trí nóng hổi nhất** từ nhóm **HKP25_26_NHOM04**.

    @if ($name && $name !== 'Bạn')
        **Xin chào:** {{ $name }}
    @endif

    **Email đăng ký:** `{{ $email }}`

    ---

    ### Bạn sẽ nhận được:
    - Tin tức showbiz 24/7
    - Phỏng vấn nghệ sĩ độc quyền
    - Sự kiện, liveshow sắp tới

    <x-mail::button :url="route('index')">
        Xem tin tức ngay
    </x-mail::button>

    Nếu bạn không đăng ký, vui lòng bỏ qua email này.

    ---

    Trân trọng,
    **{{ config('app.name') }}**
    Nhóm phát triển: **HKP25_26_DAWED_NHOM04**
</x-mail::message>
