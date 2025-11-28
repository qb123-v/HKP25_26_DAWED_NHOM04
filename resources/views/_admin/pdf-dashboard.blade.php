<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thống kê Dashboard - {{ now()->format('d/m/Y') }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 30px;
        }

        h1 {
            color: #dc3545;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #f8f9fa;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BÁO CÁO THỐNG KÊ HỆ THỐNG</h1>
        <p>Ngày xuất: {{ $generatedAt }}</p>
    </div>

    <table>
        <tr>
            <th>Tổng bài viết</th>
            <th>Tổng lượt xem</th>
            <th>Tổng bình luận</th>
            <th>Số người đăng ký</th>
        </tr>
        <tr>
            <td><strong>{{ number_format($totalArticles) }}</strong></td>
            <td><strong>{{ number_format($totalViews) }}</strong></td>
            <td><strong>{{ number_format($totalComments) }}</strong></td>
            <td><strong>{{ number_format($totalSubscription) }}</strong></td>
        </tr>
    </table>

    <h2 style="margin-top: 40px; color: #0d6efd;">Top 20 bài viết xem nhiều nhất</h2>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Nghệ sĩ</th>
                <th>Bình luận</th>
                <th>Lượt xem</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topArticles as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align:left;">{{ Str::limit($item->title, 60) }}</td>
                    <td>{{ $item->artist?->name ?? '—' }}</td>
                    <td>{{ number_format($item->comments_count ?? 0) }}</td>
                    <td>{{ number_format($item->views) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
