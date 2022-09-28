<!-- ======= Games Section ======= -->
<section id="games" class="game">
    <div class="container">

        <div class="section-title">
            <h2>OUR <span>GAMES</span></h2>
            <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>

        <div class="row">
            @foreach ($platforms as $platform)
            <div class="col-sm-6 mt-5">
                <div class="game-pic"><img src="{{ $platform->image }}" alt="{{ $platform->platform }}" class="img-responsive">
                    <span class="credential-bg">
                        <ul class="list-unstyled button-group text-center">
                            <li><a href="{{ $platform->download_link }}" class="btn btn-download">Download</a></li>
                            @auth
                            <li>
                                <ul class="list-unstyled">
                                    <li><strong>User: </strong><span>{{ getUsername($platform->id) }}</span></li>
                                    <li><strong>Password: </strong><span>{{ getPassword($platform->id) }}</span></li>
                                </ul>
                            </li>
                            @endauth
                        </ul>
                    </span>
                </div>
            </div>
            @endforeach           
        </div>
</section>
<!-- End Games Section -->
