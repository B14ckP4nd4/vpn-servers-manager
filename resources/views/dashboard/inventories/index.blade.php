<x-app-layout>
    <div class="wrapper">
        <x-navigation></x-navigation>
        <div class="page-wrapper">
            <livewire:inventories></livewire:inventories>
            <x-footer></x-footer>
        </div>
    </div>


    <!-- Tabler Core -->
    <script src="{{asset('js/dashboard/dashboard.js?'. time())}}"></script>


</x-app-layout>
