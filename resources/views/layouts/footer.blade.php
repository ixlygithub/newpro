<footer class="footer">
    <div class="container-fluid">
        <ul class="nav">
            <li class="nav-item">
                <a href="https://creative-tim.com" target="blank" class="nav-link">
                    <!-- {{ __('Creative Tim') }} -->
                </a>
            </li>
            <li class="nav-item">
                <a href="https://updivision.com" target="blank" class="nav-link">
                   <!--  {{ __('Updivision') }} -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <!-- {{ __('About Us') }} -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <!-- {{ __('Blog') }} -->
                </a>
            </li>
        </ul>
        @if(Request::is('admin'))
        <div class="copyright admin_copy">
            &copy; {{ now()->year }} {{ __('made with') }} <i class="tim-icons icon-heart-2"></i> {{ __('by') }}
            <a href="https://www.sibzsolutions.com/" target="_blank">{{ __('Sibz Solutions') }}</a> &amp;
            <!-- <a href="https://updivision.com" target="_blank">{{ __('Updivision') }}</a> --> {{ __('for a better web') }}.
        </div>
        @else
        <div class="copyrights">
            &copy; {{ now()->year }} {{ __('made with') }} <i class="tim-icons icon-heart-2"></i> {{ __('by') }}
            <a href="https://www.sibzsolutions.com/" target="_blank">{{ __('Sibz Solutions') }}</a> &amp;
            <!-- <a href="https://updivision.com" target="_blank">{{ __('Updivision') }}</a> --> {{ __('for a better web') }}.
        </div>
        @endif
    </div>
</footer>
<style>
.copyright.admin_copy {
    color: #fff;
}
    </style>
</style>
