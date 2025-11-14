<div class="newsletter-form p-4 bg-light rounded shadow-sm">
    <h6 class="fw-bold mb-3">Đăng ký nhận tin tức</h6>
    <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
        @csrf
        <div class="input-group mb-2">
            <input 
                type="email" 
                name="email" 
                class="form-control form-control-sm" 
                placeholder="you@example.com" 
                required
            >
            <button type="submit" class="btn btn-primary btn-sm">
                Gửi
            </button>
        </div>
        <div id="newsletterMessage" class="small mt-1"></div>
    </form>
</div>

@push('stylesjs')
<script>
document.getElementById('newsletterForm').onsubmit = async function(e) {
    e.preventDefault(); // Ngăn reload trang

    const form = e.target;
    const message = document.getElementById('newsletterMessage');
    const formData = new FormData(form);

    message.innerHTML = '<span class="text-info">Đang gửi...</span>';

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();

        if (data.success) {
            message.innerHTML = `<span class="text-success">Đăng ký thành công! Check email ${data.email}</span>`;
            form.reset();
        } else {
            message.innerHTML = '<span class="text-danger">' + 
                (data.message || 'Lỗi, vui lòng thử lại!') + '</span>';
        }
    } catch (error) {
        message.innerHTML = '<span class="text-danger">Lỗi kết nối!</span>';
    }
};
</script>
@endpush