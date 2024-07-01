@extends('admin.layouts.index')

@section('title', 'Dashboard')

@section('main')
    <div class="row">
        <!-- New Booking Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>New Booking</h5>
                        <h2 class="card-value">{{ $newBookings }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customers Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Customers</h5>
                        <h2 class="card-value">{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Active Reservations Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Active Reservations</h5>
                        <h2 class="card-value">{{ $activeReservations }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Revenue Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Revenue</h5>
                        <h2 class="card-value">Rp{{ number_format($revenue, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Additional Cards for Weekly, Monthly, and Yearly Earnings -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Weekly Earnings</h5>
                        <h2 class="card-value">Rp{{ number_format($weeklyEarnings, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Monthly Earnings</h5>
                        <h2 class="card-value">Rp{{ number_format($monthlyEarnings, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Yearly Earnings</h5>
                        <h2 class="card-value">Rp{{ number_format($yearlyEarnings, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Available Rooms Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Available Rooms</h5>
                        <h2 class="card-value">{{ $availableRooms }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booked Rooms Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card custom-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <i class="fas fa-door-closed"></i>
                    </div>
                    <div class="text-wrapper">
                        <h5>Booked Rooms</h5>
                        <h2 class="card-value">{{ $bookedRooms }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .custom-card {
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, .15);
            transition: transform 0.2s;
        }

        .custom-card:hover {
            transform: translateY(-10px);
        }

        .custom-card .card-content {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .custom-card .icon-wrapper {
            flex: 0 0 70px;
            text-align: center;
        }

        .custom-card .icon-wrapper i {
            font-size: 3rem;
            color: #4e73df;
        }

        .custom-card .text-wrapper {
            margin-left: 20px;
            flex: 1;
            overflow: hidden;
        }

        .custom-card .text-wrapper h5 {
            margin: 0;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custom-card .text-wrapper h2 {
            margin: 0;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-value {
            font-size: calc(1.5rem + 1vw);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 576px) {
            .custom-card .text-wrapper h2 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection

@section('js')
@endsection

@section('script')
@endsection
