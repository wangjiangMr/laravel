@extends('layouts.master_nohead')


@section('body')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Main Content -->
                <h1 class="text-center">Coming Soon...</h1>
                <p class="lead text-center">
                    We are currently working on a new version of our website.<br />
                    Enter your e-mail below to stay tuned.
                </p>
                <form class="form-inline text-center" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="email">Email address</label>
                        <input type="email" class="form-control border-color col-sm-12" id="email" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn btn-danger">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div id="countdown"></div>
            </div>
        </div>  <!-- / .row -->
    </div> <!-- / .container -->
@stop
