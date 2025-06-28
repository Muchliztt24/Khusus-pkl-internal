@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Selamat datang di halaman admin</h1>
        <p>Ini adalah halaman utama untuk admin.</p>
        <div class="row gx-3">
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white bg-primary rounded">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-layout-grid fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">450</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  New Products
                </p>
              </div>
            </div>
            </div>
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-success">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-archive fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">50</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  Pending Apps
                </p>
              </div>
            </div>
            </div>
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-warning">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-users fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">80</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  New Customers
                </p>
              </div>
            </div>
            </div>
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-danger">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-gift fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">15</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  Birthday Gifts
                </p>
              </div>
            </div>
            </div>
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-info">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-credit-card fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">1800</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  Total Budgets
                </p>
              </div>
            </div>
            </div>
            <div class="col-lg-4 col-xxl-2 col-6">
            <div class="card text-white text-bg-secondary">
              <div class="card-body p-4">
                <span>
                  <i class="ti ti-brand-github fs-8"></i>
                </span>
                <h3 class="card-title mt-3 mb-0 text-white">90</h3>
                <p class="card-text text-white-50 fs-3 fw-normal">
                  Best Designers
                </p>
              </div>
            </div>
            </div>
            </div>
        </div>
    @endsection
