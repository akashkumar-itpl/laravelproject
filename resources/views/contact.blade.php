@extends('layouts.site')

@section('content')
@php 
$footerData = getFooterData();
@endphp
        <section class="inner-page-banner">

            <div class="container-fluid">

                <img src="{{ URL::asset('storage/media/'.$pageData->banner)}}">

            </div>

            <div class="container">

                <div class="col-md-12">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Contact</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </section>

        <section class="contact-section">

            <div class="container">

                <div class="section-title text-center">

                    <span>GET IN TOUCH</span>

                    <h2>Let's Start a Conversation</h2>

                </div>

                <div class="row">

                    <!-- Contact Info -->

                    <div class="col-lg-4">

                        <div class="contact-info">

                            <h3>Contact Information</h3>

                            <div class="info-box">

                                <div class="icon">

                                    <i class="fas fa-location-dot"></i>

                                </div>

                                <div>

                                    <h5>Corporate Office</h5>

                                    <p>{{ $footerData['address'] }}</p>

                                </div>

                            </div>

                            <div class="info-box">

                                <div class="icon">

                                    <i class="fas fa-location-dot"></i>

                                </div>

                                <div>

                                    <h5>Aluminium Foil Rolling Plant</h5>

                                    <p>{{ $footerData['address_2'] }}</p>

                                </div>

                            </div>

                            <div class="info-box">

                                <div class="icon">

                                    <i class="fas fa-phone"></i>

                                </div>

                                <div>

                                    <h5>Call Us</h5>

                                        <a href="tel:{{ $footerData['contact_2'] }}">
                                        <p>{{ $footerData['contact_2'] }}</p>
                                        </a>

                                </div>

                            </div>

                            <div class="info-box">

                                <div class="icon">

                                    <i class="fas fa-envelope"></i>

                                </div>

                                <div>

                                    <h5>Email</h5>

                                        <a href="mailto:{{ $footerData['email_2'] }}">
                                        <p>{{ $footerData['email_2'] }}</p>
                                        </a>
                                </div>

                            </div>

                        </div> 

                    </div>

                    <!-- Contact Form -->

                    <div class="col-lg-8">

                        <div class="contact-form">

                            <h3>Send us a Message</h3>

                            <form id="contact_form" action="#" method="POST">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-md-6 form-group">

                                        <input type="text" class="form-control" placeholder="Full Name" name="name" id="name">
                                        <span class="text-danger error-text name_err"></span>

                                    </div>

                                    <div class="col-md-6 form-group">

                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
                                        <span class="text-danger error-text email_err"></span>

                                    </div>

                                    <div class="col-md-6 form-group">

                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" maxlength="10" oninput="validateNumberInput(this)">
                                        <span class="text-danger error-text phone_err"></span>

                                    </div>

                                    <div class="col-md-6">

                                        <input type="text" class="form-control" placeholder="Subject" name="subject">

                                    </div>

                                    <div class="col-md-12">

                                        <textarea rows="4" class="form-control" name="msg" placeholder="Your Message"></textarea>

                                    </div>

                                    <div class="col-md-12">

                                   
                                        <button type="submit" name="submit" id="submit" class="contact-btn readbutis">Send Message <i class="fas fa-arrow-right"></i></button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
$(document).ready(function() {
  $('#contact_form').on('submit', function(event) {
event.preventDefault();
$.ajax({
  url: "contact-post-form",
  method: "POST",
  data: $(this).serialize(),
  dataType: "json",
  beforeSend: function() {
    var loadingHTML = '<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>'
    $('.readbutis').append(loadingHTML);
    $('.readbutis').attr('disabled', 'disabled');
  },
  success: function(data) {
    if ($.isEmptyObject(data.error)) {
                      $(".readbutis").find(':submit').attr('disabled', false);
                  
                     //window.location.href = "thank-you";
                        Swal.fire({
                        icon: 'success',
                        title: 'Message Sent Successfully!',
                        text: 'Our team will contact you shortly.',
                        showConfirmButton: false,
                        timer: 2500,
                        background: '#f8fafc',
                        });                        
                        window.location.href = "";     
                 } else {
                     $(".readbutis").find(':submit').attr('disabled', false);
                     printErrorMsg(data.error);
                 }
    $('.readbutis').removeAttr('disabled');
    $('.readbutis').find('.fa-spin').remove();
  }
})
});
    function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
            $('.' + key + '_err').text(value);
        });
        $('html, body').animate({
            scrollTop: $('.' + Object.keys(msg)[0] + '_err').parent().offset().top
        }, 1500);
    }
});
</script>
<script>
    function validateNumberInput(input) {
        // Remove any non-digit characters
        input.value = input.value.replace(/\D/g, '');
    }
</script>
        @endsection