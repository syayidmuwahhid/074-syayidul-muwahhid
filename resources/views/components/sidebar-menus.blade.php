<div class="menu-item py-2">
    @php($status = $menu["title"] == $position ? "active" : "")
    <a class="menu-link {{ $status }} menu-center" href="{{ $menu['url'] }}" title="{{ $menu['title'] }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
        <span class="menu-icon me-0">
            <i class="bi bi-{{ $menu['icon'] }} fs-1"></i>
        </span>
    </a>
</div>
