@extends('layouts.front')

@section('content')
<!-- Hero Section -->
<div id="heroCarousel" class="carousel slide mb-0" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#heroCarousel" data-slide-to="1"></li>
        <li data-target="#heroCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&h=700&fit=crop&q=80" class="d-block w-100" alt="Bus on a bridge">
            <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
                <div class="text-center text-white">
                    <h1 class="display-3 font-weight-bold">Welcome to TixBus</h1>
                    <p class="lead mb-4">Your comfortable journey starts here. Book bus tickets easily and securely.</p>
                    <a href="#rides-section" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm font-weight-bold">Book Now</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1570125909232-eb263c186902?w=1600&h=700&fit=crop&q=80" class="d-block w-100" alt="Bus on a road">
            <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
                <div class="text-center text-white">
                    <h1 class="display-3 font-weight-bold">Explore New Destinations</h1>
                    <p class="lead mb-4">Find the best routes and prices for your next adventure.</p>
                    <a href="#rides-section" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm font-weight-bold">See Routes</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1525962952978-125c05a85618?w=1600&h=700&fit=crop&q=80" class="d-block w-100" alt="Bus interior">
            <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
                <div class="text-center text-white">
                    <h1 class="display-3 font-weight-bold">Travel in Comfort</h1>
                    <p class="lead mb-4">Modern buses with all the amenities for a pleasant trip.</p>
                    <a href="#rides-section" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm font-weight-bold">Book Your Seat</a>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
</div>

<!-- Features Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="text-primary mb-3"><i class="fas fa-check-circle fa-3x"></i></div>
                <h5 class="font-weight-bold">Easy Booking</h5>
                <p class="text-muted">Book your tickets in just a few clicks without any hassle.</p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="text-primary mb-3"><i class="fas fa-shield-alt fa-3x"></i></div>
                <h5 class="font-weight-bold">Secure Payments</h5>
                <p class="text-muted">We ensure secure payment processing for your peace of mind.</p>
            </div>
            <div class="col-md-4">
                <div class="text-primary mb-3"><i class="fas fa-bus-alt fa-3x"></i></div>
                <h5 class="font-weight-bold">Comfortable Rides</h5>
                <p class="text-muted">Enjoy a comfortable journey with our premium bus partners.</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5" id="rides-section">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-primary">{{ trans('front.upcoming_rides') }}</h2>
                <p class="text-muted">Choose your destination and book your seat today.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success shadow-sm" role="alert">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('status') }}
                </div>
            @endif

            <div class="rides-container">
                @forelse ($ridesDates as $date => $rides)
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <i class="far fa-calendar-alt text-primary mr-2 fa-lg"></i>
                        <h5 class="mb-0 font-weight-bold text-dark">{{ $date }}</h5>
                    </div>
                    
                    @foreach ($rides as $ride)
                        <div class="card mb-3 shadow-sm border-0 ride-card">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center mb-3 mb-md-0">
                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-bus fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <h5 class="font-weight-bold mb-1">{{ $ride->route }}</h5>
                                        <div class="text-muted small">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ Carbon\Carbon::parse($ride->departure_time)->format('H:i') }}
                                            <span class="mx-2">&mdash;</span>
                                            {{ Carbon\Carbon::parse($ride->arrival_time)->format('H:i') }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <button type="button" class="btn btn-primary px-4 rounded-pill shadow-sm" onclick="openBookingModal({{ $ride->id }})">
                                            {{ trans('front.book_now') }} <i class="fas fa-arrow-right ml-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No upcoming rides found.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bookingModalLabel">
                    <i class="fas fa-ticket-alt mr-2"></i> {{ trans('front.book_now') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('rides.book') }}">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" id="ride" name="ride_id" value="{{ old('ride_id') }}">

                    @error('alert')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-muted small text-uppercase">{{ trans('front.name') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span></div>
                            <input type="text" name="name" id="name" class="form-control border-left-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Your Name">
                        </div>
                        @error('name')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="font-weight-bold text-muted small text-uppercase">{{ trans('front.email') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span></div>
                            <input type="email" name="email" id="email" class="form-control border-left-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="name@example.com">
                        </div>
                        @error('email')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="font-weight-bold text-muted small text-uppercase">{{ trans('front.phone_number') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text bg-light border-right-0"><i class="fas fa-phone text-muted"></i></span></div>
                            <input type="text" name="phone" id="phone" class="form-control border-left-0 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required placeholder="+1 234 567 890">
                        </div>
                        @error('phone')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">{{ trans('front.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .ride-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .ride-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    .input-group-text { background-color: #fff; }
    .form-control:focus { box-shadow: none; border-color: #ced4da; }
    .form-control:focus + .input-group-prepend .input-group-text { border-color: #80bdff; }

    .carousel-item {
        height: 80vh;
        min-height: 400px;
    }
    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 80vh;
        min-height: 400px;
        object-fit: cover;
        z-index: 1;
    }
    .carousel-item::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 2;
    }
    .carousel-caption { top: 0; left: 0; right: 0; bottom: 0; z-index: 3; }
    .carousel-caption h1, .carousel-caption p { text-shadow: 2px 2px 8px rgba(0,0,0,0.8); }
</style>
@endsection

@section('scripts')
<script>
    function openBookingModal(rideId) {
        $('#ride').val(rideId);
        $('#bookingModal').modal('show');
    }

    @if ($errors->any())
        $(document).ready(function() {
            $('#bookingModal').modal('show');
        });
    @endif
</script>
@endsection
