<div style="margin-bottom:12px; font-size:14px; color:#6b7280;">
    <a href="{{ route('articles.index') }}">Trang chủ</a>
    @if (request()->routeIs('articles.index')) / <span>Danh sách bài viết</span>
    @elseif(request()->routeIs('articles.create')) / <a href="{{ route('articles.index') }}">Articles</a> / <span>Tạo bài viết</span>
    @elseif(request()->routeIs('articles.edit')) / <a href="{{ route('articles.index') }}">Articles</a> / <span>Sửa bài viết</span>
    @elseif(request()->routeIs('articles.show')) / <a href="{{ route('articles.index') }}">Articles</a> / <span>Chi tiết</span>
    @endif
</div>
