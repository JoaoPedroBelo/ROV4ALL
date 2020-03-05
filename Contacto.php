<!DOCTYPE HTML>
<html>

<head>
    <title>Projeto ROV4ALL</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="https://oom.arditi.pt/ROV4ALL/favicon.ico" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script>
        $(function() {
            $("#footer").load("footer.html  #footer");

        });
    </script>
    <script>
        $(function() {
            $("#nav").load("nav.html  #nav");
        });
    </script>
</head>

<body class="landing">
    <!--Header-->
    <header id="header" class="alt">
        <!--Import NAV-->
        <div id="nav">
        </div>
    </header>
 <?php 
$DisplayForm=true;
$DisplayFormERROR=false;

if(isset($_POST['submit']))
{
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LeKk9QUAAAAABvVXONx5tt93MAO2zwJ-PPUFN7X',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        $DisplayFormERROR=true;
    } else {
        $DisplayForm=false;
        $to = "sonia.costa@oom.arditi.pt";
        $subject = "ROV4ALL ".$_POST['assunto'];
        
        $message = "<html>
        <head>
        <title>Pedido de Contacto ROV4ALL</title>
        </head>
        <body>
        <p>Nome: ".$_POST['name']. "</p>
        <p>Email: ".$_POST['email']. "</p>
        <p>Contacto: ".$_POST['contacto']. "</p>
        <p>Assunto: ".$_POST['assunto']."</p>
        <p>Mensagem: ".$_POST['messagem']. "</p>
        </body>
        </html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        
        mail($to,$subject,$message,$headers);
    }
    
} 
   

?>

    <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
    <!-- Banner -->
    <section id="banner">
        <h2 style="margin-top: 3rem !important">Contacto</h2>
        <p> Esclareça as dúvidas</p>
        <!--<ul class="actions">
					<li><a href="#" class="button special big">Get Started</a></li>
				</ul> -->
    </section>
    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="container">
            <p align="justify">
            <?php 
            if($DisplayForm){ ?>
                <form action="Contacto.php" id="contact_form" method="POST">
                     Nome:
                    <input type="text" name="name" placeholder="Insira o seu nome" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o seu nome')" required/>
                    Email:
                    <input type="email" name="email" placeholder="Insira o seu email" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o seu email')" required/>
                    Contacto:
                    <input type="text" name="contacto" pattern="[0-9]+$" placeholder="Insira o seu contacto" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o seu contacto')" required/>
                    Assunto:
                    <input type="text" name="assunto" placeholder="Insira o assunto do contacto" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o assunto do contacto')" required/>
                    Mensagem:
                    <textarea name="messagem" rows="10" cols="30" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('Insira o sua mensagem')" required=""></textarea>
                    Verificação de segurança:
                    <div class="g-recaptcha" data-sitekey="6LeKk9QUAAAAACB1gAxG9pp2k8RW7x3LVGqu9YrJ"></div>
                    <p style="padding-top: 15px;">
                    <input type="submit" class="button special big" value="Submeter" name="submit"/>
                    </p>
                </form>
            <?php }?>
            <?php 
            if($DisplayForm==false){ ?>
                    <p>Recebemos o seu contacto, iremos ser breves</p>
                    
                </form>
                
                <?php }?>
                <?php 
            if($DisplayFormERROR==true){ ?>
                    <p style > valide a opção de segurança, é importante para nos.</p>
                    
                </form>
                
                <?php }?>
        </div>
    </section>

    <!-- Footer -->
    <div id="footer">
        <!-- import from page footer -->
    </div>
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js "></script>
    <script src="assets/js/skel.min.js "></script>
    <script src="assets/js/util.js "></script>
    <script src="assets/js/main.js "></script>

</body>

</html>

