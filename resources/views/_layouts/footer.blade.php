<footer>
    <x-newsletter-form />
    <div class="footer-container"
        style="background-color: {{ $footers['bg_color'] ?? '#000' }}; color: {{ $footers['color'] ?? '#fff' }};">
        <h1 class="footer-title">SHOWBIZ</h1>
        <div class="footer-content">
            <div class="footer-info">
                <p>Thông tin công ty: {{ $footers['company_name'] ?? 'Chưa cập nhật thông tin công ty' }}</p>
                <p>Địa chỉ: {{ $footers['address'] ?? 'Chưa cập nhật địa chỉ' }}</p>
                <p>Email: {{ $footers['email'] ?? 'Chưa cập nhật email' }}</p>
                <p>Điện thoại: {{ $footers['phone_number'] ?? 'Chưa cập nhật số điện thoại' }}</p>
            </div>
            <div class="footer-info">
                <p><a style="color: {{ $footers['color'] ?? '#fff' }};" href="#">Về chúng tôi</a></p>
                <p><a style="color: {{ $footers['color'] ?? '#fff' }};" href="{{ route('articles') }}">Tin tức</a></p>
                <p><a style="color: {{ $footers['color'] ?? '#fff' }};" href="#">Dịch vụ</a></p>
                <p><a style="color: {{ $footers['color'] ?? '#fff' }};" href="#">Chính sách</a></p>
            </div>
            <div class="footer-info">
            </div>
        </div>
        <p class="footer-copy">© 2024 SHOWBIZ. All rights reserved.</p>
    </div>
</footer>