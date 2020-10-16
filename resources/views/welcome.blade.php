@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-center ">
                <h3 class="top-c-sep">Grow your career with us </h3>
                <p>IT and communication job from over 7 sites in a single website.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">

                <form action="/search" class="career-form mb-60">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="input-group position-relative">
                                <input type="text" class="form-control" placeholder="Enter Your Keywords" id="searchText" name="searchText" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select">
                                    <option selected="">Location</option>
                                    <option value="1">Jaipur</option>
                                    <option value="2">Pune</option>
                                    <option value="3">Bangalore</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select">
                                    <option selected="">Select Job Type</option>
                                    <option value="1">Ui designer</option>
                                    <option value="2">JS developer</option>
                                    <option value="3">Web developer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <button type="submit" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>

                <div class="filter-result">
                    <p class="mb-30 ff-montserrat"> There are currently <span style="font-weight: bold;"><?php echo DB::table('jobs')->count(); ?></span> job openings</p>

                    @if(!empty($jobs))
                    @foreach($jobs as $job)
                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                FD
                            </div>
                            <div class="job-content">
                                <h5 class="text-center text-md-left"> {{ $job->name }}</h5>
                                <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                    <li class="mr-md-4">
                                        <i class="zmdi zmdi-pin mr-2"></i> {{$job->address}}
                                    </li>
                                    <li class="mr-md-4">
                                        <i class="zmdi zmdi-money mr-2"></i> {{$job->salary}}
                                    </li>
                                    <li class="mr-md-4">
                                        <i class="zmdi zmdi-time mr-2"></i> {{$job->time}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="job-right my-4 flex-shrink-0">
                            <a href="#" class="btn d-block w-100 d-sm-inline-block btn-light">Apply now</a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>

            <!-- START Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-reset justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="zmdi zmdi-long-arrow-left"></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END Pagination -->
        </div>
    </div>

</div>
@endsection