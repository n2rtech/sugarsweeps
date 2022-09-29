  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <h2 class="text-primary">Contact</h2>
            <p class="text-center">Just send us your questions or concerns by reaching us here and we will give you the help you need.</p>
        </div>
    </div>

    <div class="container">

        <div class="row mt-5 mb-5">

            <div class="col-lg-8 mt-5 mt-lg-0 align-items-stretch m-auto">

                <form action="{{ route('contact-us') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name" data-rule="minlen:4"
                                data-msg="Please enter at least 4 chars" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" data-rule="email"
                                data-msg="Please enter a valid email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject"
                            placeholder="Subject" data-rule="minlen:4"
                            data-msg="Please enter at least 8 chars of subject" />
                            @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required"
                            data-msg="Please write something for us" placeholder="Message"></textarea>
                            @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                </form>

            </div>

        </div>

    </div>
</section>
<!-- End Contact Section -->
