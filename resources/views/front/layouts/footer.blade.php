<!-- Footer - start -->
<footer class="footer-wrap">


    <div class="container f-menu-list">
    
        <div class="row">
             <div class="f-menu">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="http://centrocaffe.ch/">www.centrocaffe.ch</a></li>
                    <li><p>Althardstrasse 160</p></li>
                    <li><p></i>CH-8105 Regensdorf</p></li>
                </ul>
            </div>
            
             <div class="f-menu">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ url('agb') }}">AGB's</a></li>
                    <li><a href="{{ url('impressum') }}">Impressum</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fa fa-envelope-open-o" aria-hidden="true"></i>Kontakt</a></li>
                </ul>
            </div>
            
            <div class="f-menu">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
                    
                </ul>
            </div>
            
            <div class="f-menu">
                <ul class="nav nav-pills nav-stacked">
                    <li>Zahlungsmöglichkeiten:</li> 
                    <li><img src="{{ asset('front/assets/img/cards/visa.png') }}" alt=""></li>
                    <li><img src="{{ asset('front/assets/img/cards/master-card.png') }}" alt=""></li>
                    <li><img src="{{ asset('front/assets/img/cards/american-express.png') }}" alt=""></li>
                </ul>
            </div>
            <div class="f-subscribe">
                <h3>Newsletter abonnieren</h3>
                <form method="post" action="{{ route('subscribe') }}" class="f-subscribe-form">
                    {{ csrf_field() }}
                    <input placeholder="Emailadresse" type="email" name="email" required>
                    <button type="submit"><i class="fa fa-paper-plane"></i></button>
                </form>
                <p>Geben Sie Ihre Emailadresse ein, wenn Sie unseren Newsletter erhalten möchten. Abonnieren Sie jetzt!</p>
            </div>
        </div>
    </div>



</footer>
<!-- Footer - end -->