<div class="app-sidebar">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}" class="logo-icon"><span class="logo-text">{{ $appset->name }}</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset('avatar.png') }}">
                <span class="user-info-text">Hello<br><span
                        class="user-state-info">{{ explode(' ', auth()->user()->name)[0] }}</span></span>
            </a>
        </div>
    </div>

    <div class="app-menu">
        <ul class="accordion-menu">
            <x-single-sidebar :routes="['dashboard.index']" label="Dashboard" icon="dashboard" />
            <x-multi-sidebar
                route="['profile.index', 'archieve.index', 'archieve.update', 'article.index', 'article.update', 'article.add']"
                label="Master Data" icon="folder_copy" :submenus="[
                    [
                        'route' => ['profile.index'],
                        'label' => 'Profile',
                    ],
                    [
                        'route' => ['archieve.index', 'archieve.update'],
                        'label' => 'Archieve',
                    ],
                    [
                        'route' => ['article.index', 'article.add', 'article.update'],
                        'label' => 'Article',
                    ],
                ]" />
            <x-single-sidebar :routes="['appsetting.index']" label="App Setting" icon="settings" />
        </ul>
    </div>
</div>
