<x-layouts.app :title="__('Dashboard')">
    <div class="d-flex flex-column h-100 gap-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h5 class="card-title">Dashboard Card 1</h5>
                            <p class="card-text text-muted">Sample content placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h5 class="card-title">Dashboard Card 2</h5>
                            <p class="card-text text-muted">Sample content placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h5 class="card-title">Dashboard Card 3</h5>
                            <p class="card-text text-muted">Sample content placeholder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card flex-grow-1">
            <div class="card-body dashboard-card d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <h5 class="card-title">Main Dashboard Content</h5>
                    <p class="card-text text-muted">This is the main content area of the dashboard</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
