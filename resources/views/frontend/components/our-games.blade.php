<!-- ======= Games Section ======= -->
<section id="games" class="game">
    <div class="container">

        <div class="section-title">
            <h2>OUR <span class="text-primary">GAMES</span></h2>
            <p class="text-center">WE PROVIDE THE MOST POPULAR GAMES IN THE MARKET. REGISTER AN ACCOUNT, REQUEST A
                USERNAME AND PASSWORD FOR THE GAME YOU WANT TO PLAY, THEN RELOAD YOUR ACCOUNT AND WIN BIG! REQUEST
                TO REDEEM AT ANY TIME FROM YOUR DRAGONSTAKES ACCOUNT.</p>
        </div>

        <div class="row">
            @foreach ($platforms as $platform)
                <div class="card col-6 col-sm-4 col-md-3 my-3">
                    <div class="row mt-3">
                        <table class="h-100 w-100">
                            <tbody>
                                <tr>
                                    <td class="w-100 col-6 text-center font-weight-bold align-middle">
                                        <img src="{{ $platform->image }}" alt="" class="img-fluid">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row h-25 mt-3">
                        <table class="h-100 w-100">
                            <tbody>
                                <tr>
                                    <td class="w-100 col-6 text-center font-weight-bold align-middle">
                                        <a href="{{ $platform->download_link }}" target="_blank"
                                            class="btn btn-sm btn-outline-danger">Download</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row h-50 mt-4 mb-3">
                        <table class="h-100 w-100 f-14">
                            <tbody>
                                <tr>
                                    <td class="w-75 col-6 text-left font-weight-bold align-middle">Username</td>
                                    <td class="w-25 col-6 text-right font-weight-bold align-middle">905800</td>
                                </tr>
                                <tr>
                                    <td class="w-75 col-6 text-left font-weight-bold align-middle">Password</td>
                                    <td class="w-25 col-6 text-right font-weight-bold align-middle">Abc123</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
</section>
<!-- End Games Section -->
