<footer class="site-footer">
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('FrontCliente/TelaInicial/logosite.png') }}" alt="AutoPrime" class="footer-logo">
                    <span class="ms-2 h5 mb-0">AutoPrime</span>
                </div>
                <p class="small text-white-50 mb-3">
                    Conectando você ao seu próximo veículo com transparência, qualidade e as melhores condições.
                </p>
                <div class="footer-social d-flex gap-2">
                    <a href="#" aria-label="Instagram" title="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
                            <path d="M12.5 1h-9A2.5 2.5 0 0 0 1 3.5v9A2.5 2.5 0 0 0 3.5 15h9a2.5 2.5 0 0 0 2.5-2.5v-9A2.5 2.5 0 0 0 12.5 1Zm-9 1h9A1.5 1.5 0 0 1 14 3.5v9A1.5 1.5 0 0 1 12.5 14h-9A1.5 1.5 0 0 1 2 12.5v-9A1.5 1.5 0 0 1 3.5 2ZM12 4.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook" title="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.94 6.79H10.5V5H8.94c-1.6 0-2.44.94-2.44 2.52V9H5v1.94h1.5V15h2V10.94h1.62L10.5 9H8.5V7.52c0-.5.2-.73.44-.73Z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube" title="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15.6 4.9a2 2 0 0 0-1.41-1.42C12.86 3.11 8 3.11 8 3.11s-4.86 0-6.19.37A2 2 0 0 0 .4 4.9 21 21 0 0 0 .02 8a21 21 0 0 0 .38 3.1 2 2 0 0 0 1.41 1.42C2.86 12.89 8 12.89 8 12.89s4.86 0 6.19-.37A2 2 0 0 0 15.6 11.1 21 21 0 0 0 15.98 8a21 21 0 0 0-.38-3.1ZM6.5 10.5v-5l4 2.5-4 2.5Z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="WhatsApp" title="WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.6 2.4A7.1 7.1 0 0 0 1.7 11.3L1 15l3.8-.7a7.1 7.1 0 0 0 10-6.3c0-1.9-.7-3.6-1.9-4.6Zm-5.6 10a5.5 5.5 0 0 1-2.8-.8l-.2-.1-1.7.3.3-1.6-.1-.2a5.6 5.6 0 1 1 10.6-2.5 5.6 5.6 0 0 1-6.1 4.9Zm3-3.3c-.2-.1-1-.5-1.2-.5s-.3 0-.5.2l-.4.4c-.2.2-.3.2-.5.1s-.9-.3-1.7-1.1c-.6-.6-1.1-1.3-1.2-1.5s0-.3.1-.5l.3-.4.2-.4c.1-.2 0-.3 0-.4l-.5-1.2c-.1-.3-.3-.3-.5-.3h-.4a.8.8 0 0 0-.6.3c-.2.2-.8.8-.8 2s.8 2.3.9 2.5c.1.2 1.6 2.5 3.9 3.4.5.2.8.3 1.1.4.5.2 1 .2 1.4.1.4-.1 1-.4 1.1-.8.1-.4.1-.8.1-.9s-.2-.3-.4-.4Z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="text-uppercase">Empresa</h6>
                <ul class="list-unstyled m-0">
                    <li><a class="footer-link" href="#">Sobre</a></li>
                    <li><a class="footer-link" href="#">Carreiras</a></li>
                    <li><a class="footer-link" href="#">Blog</a></li>
                    <li><a class="footer-link" href="#">Imprensa</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h6 class="text-uppercase">Atendimento</h6>
                <ul class="list-unstyled m-0">
                    <li><a class="footer-link" href="#">Suporte</a></li>
                    <li><a class="footer-link" href="#">Política de Troca</a></li>
                    <li><a class="footer-link" href="#">Garantia</a></li>
                    <li><a class="footer-link" href="#">Concessionárias</a></li>
                </ul>
            </div>

            <div class="col-12 col-lg-3">
                <h6 class="text-uppercase">Receba novidades</h6>
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm mb-2">
                        <input type="email" name="email" class="form-control footer-input" placeholder="Seu e-mail" required>
                        <button class="btn btn-primary" type="submit">Assinar</button>
                    </div>
                    <small class="text-white-50">Sem spam. Cancele quando quiser.</small>
                </form>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center py-3 gap-2">
            <span class="small mb-0">© {{ date('Y') }} AutoPrime — Todos os direitos reservados</span>
            <ul class="nav small">
                <li class="nav-item"><a class="nav-link px-2 footer-link" href="#">Termos</a></li>
                <li class="nav-item"><a class="nav-link px-2 footer-link" href="#">Privacidade</a></li>
                <li class="nav-item"><a class="nav-link px-2 footer-link" href="#">Cookies</a></li>
            </ul>
        </div>
    </div>
</footer>
