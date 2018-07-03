<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
<?php

$price = get_post_meta(get_the_ID(), 'price', true);
// echo 'price';
// echo $price;
$sale_price = get_post_meta(get_the_ID(), 'sale_price', true);
// echo 'sale_price';
// echo $sale_price;

// echo esc_attr(stm_listing_price_view($price));

//Generating mail
$required_fields = array(
    'make' => __('Make', 'motors'),
    'model' => __('Model', 'motors'),
    'first_name' => __('User details<br/>First name', 'motors'),
    'last_name' => __('Last name', 'motors'),
);

$non_required_fields = array(
    'transmission' => __('Transmission', 'motors'),
    'mileage' => __('Mileage', 'motors'),
    'vin' => __('Vin', 'motors'),
    'exterior_color' => __('Exterior color', 'motors'),
    'interior_color' => __('Interior color', 'motors'),
    'owner' => __('Owner', 'motors'),
    'exterior_condition' => __('Exterior condition', 'motors'),
    'interior_condition' => __('Interior condition', 'motors'),
    'accident' => __('Accident', 'motors'),
    'stm_year' => __('Year', 'motors'),
    'video_url' => __('Video url', 'motors'),
    'comments' => __('Comments', 'motors')
);

if(is_singular(stm_listings_post_type())) {
    $body = __(sprintf('Request for %s', get_the_title()), 'motors');
} else {
    $body = '';
}
$mail_send = false;

$errors = array();

// Sanitize required fields
foreach($required_fields as $key => $field) {

    //Check default fields
    if(!empty($_POST[$key])) {
        $body .= $field . ' - ' . sanitize_text_field($_POST[$key]) . '<br/>';
    } else {
        $errors[$key] = __('Please fill', 'motors') . ' ' . $field . ' ' . __('field', 'motors') . '<br/>';
    }

}

// Check email
if(!empty($_POST['email']) and is_email($_POST['email'])) {
    $body .= __('Email', 'motors') . ' - ' . sanitize_email($_POST['email']) . '<br/>';
} else {
    $errors['email'] = __('O e-mail informado é invalido', 'motors') . '<br/>';
}

// Check phone
if(!empty($_POST['phone']) and is_numeric($_POST['phone'])) {
    $body .= __('Phone', 'motors') . ' - ' . intval($_POST['phone']) . '<br/>';
} else {
    $errors['phone'] = __('Telefone invalido', 'motors') . '<br/>';
}

// Non required fields
foreach($non_required_fields as $key => $field) {
    if(!empty($_POST[$key])) {
        if($key == 'video_url') {
            $body .= $field . ' - ' . esc_url($_POST['video_url']) . '<br/>';
        } else {
            $body .= $field . ' - ' . sanitize_text_field($_POST[$key]) . '<br/>';
        }
    }
}

if( ! empty( $_FILES ) ) {
    $body .= __('Uploaded images', 'motors') .':<br/>';
    foreach( $_FILES as $file ) {
        if( is_array( $file ) ) {
            $attachment_id = stm_upload_user_file( $file );
            $url = wp_get_attachment_url($attachment_id);
            $body .= $url . '<br/>';
        }
    }
}

if(!empty($body) and empty($errors)) {

    $to      = get_bloginfo( 'admin_email' );
    if(is_singular(stm_listings_post_type())) {
        $subject = esc_html__( 'Car trade in request', 'motors' );
    } else {
        $subject = esc_html__( 'Sell a car request', 'motors' );
    }

    add_filter( 'wp_mail_content_type', 'stm_set_html_content_type' );

    wp_mail( $to, $subject, $body );

    remove_filter( 'wp_mail_content_type', 'stm_set_html_content_type' );

    $mail_send = true;
    $_POST = array();
    $_FILES = array();
}

?>

<!-- Load image on load preventing lags-->

<?php if(!$mail_send): ?>
    <div class="stm-sell-a-car-form">
        <div class="form-navigation" role="tablist">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <a href="#step_one" class="form-navigation-unit active" data-tab="step_one" role="tab" data-toggle="tab" aria-controls="step_one">
                        <div class="number heading-font">1.</div>
                        <div class="title heading-font">
                            <?php esc_html_e('Sua Proposta', 'motors'); ?></div>
                        <div class="sub-title">
                            <?php esc_html_e('Digite o valor de sua proposta', 'motors'); ?>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a href="#step_two" class="form-navigation-unit" data-tab="step_two" role="tab" data-toggle="tab" aria-controls="step_two">
                        <div class="number heading-font">2.</div>
                        <div class="title heading-font"><?php esc_html_e('Resultado da Proposta', 'motors'); ?></div>
                        <div class="sub-title"><?php esc_html_e('Verifique se sua proposta foi aceita', 'motors'); ?></div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a href="#step_three" class="form-navigation-unit" data-tab="step_three" role="tab" data-toggle="tab" aria-controls="step_three">
                        <div class="number heading-font">3.</div>
                        <div class="title heading-font"><?php esc_html_e('Fechamento', 'motors'); ?></div>
                        <div class="sub-title"><?php esc_html_e('Último passo para fechar a negociação', 'motors'); ?></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-content">
            <form method="POST" action="#error-fields" enctype="multipart/form-data">
                <!-- STEP ONE -->
                <div class="form-content-unit active" id="step_one" role="tabpanel">
                    <input type="hidden" name="sell_a_car" value="filled"/>

                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="contact-us-label"><?php esc_html_e('Valor Inicial', 'motors'); ?></div>
                                <span style="font-size: 35px;font-weight: 700;"><?php echo esc_attr(stm_listing_price_view($price)); ?></span>
                                <input type="hidden" id="value_price" value="<?php echo $price; ?>">
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="form-group">
                                <div class="contact-us-label"><?php esc_html_e('Sua proposta', 'motors'); ?></div>
                                <input type="text" id="value_discount" money-mask onkeyup="calculate()" value="<?php if(!empty($_POST['model'])) echo $_POST['model']; ?>" placeholder="Digite o valor que você deseja pagar..." name="model"  data-need="true" required/>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">


                            <div class="form-upload-files">
                                <div class="clearfix">
                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="stm-label-type-2"><?php esc_html_e('Desconto Total', 'motors'); ?></h5>
                                        <div class="upload-photos">
                                            <div style="font-size: 35px;font-weight: 700;" id="discount_percent_value"></div>
                                            <h5 class="stm-label-type-2" style="margin-top:50px;">
                                                <?php esc_html_e('Valor Nominal', 'motors'); ?>
                                            </h5>
                                            <div style="font-size: 35px;font-weight: 700;" id="discount_proposed_value"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">

                                        <center>
                                            <h5 class="stm-label-type-2" style="margin-top:8px;">
                                                <?php esc_html_e('Temperatura da Proposta', 'motors'); ?>
                                            </h5>

                                            <div class="circle">
                                                <div class="circle-frame">
                                                    <input id="discount_range_value" type="range" min="0" max="100" value="5" style="margin-top: 71px;">
                                                    <div class="circle-bg"></div>
                                                    <div class="circle-fill"></div>
                                                    <div class="circle-mask"></div>
                                                    <div id="discount_range_description" class="value"></div>
                                                </div>
                                            </div>
                                        </center>

                                    </div>
                                </div>
                            </div>
                            <img src="<?php echo get_template_directory_uri().'/assets/images/radio.png'; ?>" style="opacity:0;width:0;height:0;"/>

                        </div>
                    </div>

                    <a href="#this" class="button sell-a-car-proceed" onclick="send_to_step_2()" style="max-width: 236px;">
                        <?php esc_html_e('Avançar Negociação', 'motors'); ?>
                    </a>
                </div>

                <!-- STEP TWO -->
                <div class="form-content-unit" id="step_two" role="tabpanel">
                    <div class="vehicle-condition">
                        <div class="vehicle-condition-unit">
                            <img id="img_step_2" src=""/>
                        </div>


                    </div>
                    <a href="#this" onclick="send_to_step_3()" class="button sell-a-car-proceed">
                        <?php esc_html_e('Continuar', 'motors'); ?>
                    </a>
                </div>

                <!-- STEP THREE -->
                <div class="form-content-unit" id="step_three" role="tabpanel">
                    <div class="contact-details">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="contact-us-label"><?php esc_html_e('CPF', 'motors'); ?>*</div>
                                    <input autocomplete="off" onkeyup="TestaCPF(this)" type="text" cpf-mask value="" id="cpf_value" name="cpf"/>
                                    <input type="hidden" id="customer_id">
                                    <div class="alert alert-danger" id="cpf_value_error" role="alert"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="contact-us-label"><?php esc_html_e('Nome completo', 'motors'); ?>*</div>
                                    <input onblur="validateName()" type="text" value="" id="first_name_value" name="first_name" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group" >
                                    <div class="contact-us-label"><?php esc_html_e('E-mail', 'motors'); ?>*</div>
                                    <input type="text" value="" id="email_value" name="email" />
<!--                                    <input onblur="validateEmail()" type="text" value="" id="email_value" name="email" />-->
                                    <div class="alert alert-danger" id="email_value_error" role="alert"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group" >
                                    <div class="contact-us-label"><?php esc_html_e('Telefone', 'motors'); ?>*</div>
                                    <input tel-mask type="text" value="" id="phone_value" name="phone" />
<!--                                    <input onblur="addPhone()" tel-mask type="text" value="" id="phone_value" name="phone" />-->
                                    <div class="alert alert-danger" id="phone_value_error" role="alert"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group" >
                                    <div class="contact-us-label"><?php esc_html_e('Mensagem', 'motors'); ?></div>
                                    <textarea name="comments" id="observation_value"></textarea>
<!--                                    <textarea name="comments" onblur="addObservation()" id="observation_value"></textarea>-->
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12" id="filesList">
                                <div class="form-upload-files" style="background: #FFF;border: 3px solid #c7c7c7;">
                                    <div class="clearfix">
                                        <div class="stm-unit-photos">
                                            <h5 class="stm-label-type-2"><?php esc_html_e('Envio de Documentos Necessários', 'motors'); ?></h5>
                                            <div class="upload-photos">
                                                <div class="stm-pseudo-file-input">
                                                    <div class="stm-filename"><?php esc_html_e('Escolha o arquivo...', 'motors'); ?></div>
                                                    <!-- <div class="stm-plus"></div> -->
                                                    <input id="fileupload" class="stm-file-realfield" type="file" name="file"/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(1==2): ?>
                                            <div class="stm-unit-url">
                                                <h5 class="stm-label-type-2">
                                                    <?php esc_html_e('Link de Arquivo', 'motors'); ?>
                                                </h5>
                                                <input type="text" value="<?php if(!empty($_POST['video_url'])) echo $_POST['video_url']; ?>" name="video_url" />
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="clearfix">
                                        <table class="table">
                                            <caption>Arquivos já cadastrados</caption>
                                            <thead>
                                            <tr>
                                                <th>Link</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody id="files_list"></tbody>
                                        </table>
                                    </div>
                                </div>



                                <img src="<?php echo get_template_directory_uri().'/assets/images/radio.png'; ?>" style="opacity:0;width:0;height:0;"/>
                            </div>






                        </div>

                        <div >
                            <input type="button" onclick="enviaForm();" value="<?php esc_html_e('Finalizar Proposta', 'motors'); ?>" style="position:relative;margin-bottom:10px;" />
                        </div>
                        <div class="disclaimer">
                            <?php esc_html_e('By submitting this form, you will be requesting trade-in value at no obligation and
	will be contacted within 48 hours by a sales representative.', 'motors'); ?>
                        </div>


                    </div>
                    <div class="clearfix">

                    </div>
                </div>


                <!-- STEP FOUR -->
                <div class="form-content-unit" id="step_four" role="tabpanel">
                    <div class="vehicle-condition">
                        <div class="vehicle-condition-unit">
                            <img id="img_step_2" src="<?php echo get_template_directory_uri().'/assets/images/img_negociacao_fim.jpg'; ?>"/>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

<?php endif; ?>

<?php if(!empty($errors) and !empty($_POST['sell_a_car'])): ?>
    <div class="wpcf7-response-output wpcf7-validation-errors" id="error-fields">
        <?php foreach($errors as $error): ?>
            <?php echo $error; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if($mail_send): ?>
    <div class="wpcf7-response-output wpcf7-mail-sent-ok" id="error-fields">
        <?php esc_html_e('Mail successfully sent', 'motors'); ?>
    </div>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/js/jquery.fileupload.min.js"></script>
<script type="text/javascript">
  function calculate(){
    let price = $('#value_price').val();
    // console.log(price);
    price = parseFloat(price);

    let discount = ($('#value_discount').val() == '') ? '0' : $('#value_discount').val();
    // console.log(discount);

    discount = discount.split('.').join('');
    // console.log(discount);
    discount = discount.replace(',', '.');
    // console.log(discount);
    discount = parseFloat(discount);

    let proposed = price - discount;
    // console.log(proposed);

    let discount_proposed = new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2 }).format(proposed);
    // console.log(discount_proposed);

    let discount_percent = proposed / price * 100;
    // console.log(discount_percent)
    let discount_range = Math.round((1 - (discount_percent / 100)) * 30);

    let rest_percent = 100 - discount_percent;
    // console.log(rest_percent);
    if(rest_percent <= 70){
      discount_range_description = "Ruim"
      $('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_ruim.jpg'; ?>");
    }else if(rest_percent > 70 && rest_percent <= 85){
      discount_range_description = "Regular"
      $('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_regular.jpg'; ?>");
    }else if(rest_percent > 85 && rest_percent <= 95){
      discount_range_description = "Melhorando"
      $('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_melhorando.jpg'; ?>");
    }else if(rest_percent > 95 && rest_percent <= 98){
      discount_range_description = "Boa"
      $('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_boa.jpg'; ?>");
    }else{
      discount_range_description = "Excelente"
      $('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_excelente.jpg'; ?>");
    }

    // if(discount_percent <= 5){
    // 	discount_range_description = "Quente"
    // 	$('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_quente.png'; ?>");
    // }else if(discount_percent <= 20 && discount_percent > 5){
    // 	discount_range_description = "Morna"
    // 	$('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_morna.png'; ?>");
    // }else{
    // 	discount_range_description = "Fria"
    // 	$('#img_step_2').attr('src', "<?php echo get_template_directory_uri().'/assets/images/img_negociacao_fria.png'; ?>");
    // }


    discount_percent = discount_percent.toFixed(2).replace('.', ',');

    $('#discount_percent_value').html(`${discount_percent}%`)
    $('#discount_proposed_value').html(`R$ ${discount_proposed}`)
    $('#discount_range_description').html(discount_range_description);
    $('#discount_range_value').attr('value', discount_range);

  }
  calculate();

  function TestaCPF(strCPF) {
    strCPF = $('#cpf_value').val()
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
  }

  var customer = {};

  // function validateCPF(){
  //
  //
  //   let cpf = $('#cpf_value').val();
  //   // console.log(cpf.length);
  //   cpf = cpf.split('.').join('')
  //   // console.log(cpf);
  //   cpf = cpf.replace('-','');
  //   // console.log(cpf);
  //   // console.log(TestaCPF(cpf));
  //   // console.log(cpf.length == 11)
  //   $('#cpf_value_error').hide();
  //
  //   if(cpf.length == 11 && !TestaCPF(cpf)){
  //     $('#cpf_value_error').show();
  //     $('#cpf_value_error').html('CPF inválido');
  //   }
  //
  //   if(cpf.length == 11 && TestaCPF(cpf)){
  //     // console.log('libera_true')
  //     $('#first_name_value').val('Verificando.');
  //     $('#email_value').val('Verificando.');
  //     $('#phone_value').val('Verificando.');
  //     $('#msg_value').val('Verificando.');
  //     $('#msg_value').val('Verificando.');
  //     $('#filesList').hide();
  //
  //     // console.log(url);
  //     $.post(url, {'cpf' : cpf}, function(response){
  //       // console.log(response);
  //       customer = response.result;
  //       if(customer.id != 0){
  //         $('#filesList').show();
  //         produto = $('.test-drive-car-name').html();
  //         // console.log(produto);
  //         proposta = $('#value_discount').val();
  //         // console.log(proposta);
  //
  //         const path = `/customer/${customer.id}/?token=`;
  //
  //         const url = `${apiURL}${path}${token}`;
  //
  //         let observation = `O cliente faz uma proposta de R$${proposta} no(a) '${produto}'.`;
  //         // console.log(observation);
  //         if(observation.length > 1){
  //           $.ajax({
  //             method: "PUT",
  //             url: url,
  //             data: { observation: observation }
  //           })
  //         }
  //       }
  //       // $('#customer_id').val(customer.id);
  //       // var customer_id = customer.id;
  //       var pathUpload = `/customer/file/${customer.id}/?token=`;
  //       var urlUpload = `${apiURL}${pathUpload}${token}`;
  //       $('#fileupload').fileupload({
  //         url: urlUpload,
  //         sequentialUploads: true,
  //         success : function(response){
  //           // console.log(response);
  //           content = `
	// 											<tr>
	// 												<td>${response.url_uploaded}</td>
	// 												<td>${response.msgs}</td>
	// 											</tr>
	// 							`;
  //           $('#files_list').append(content);
  //         },
  //         complete : function(response){
  //           // console.log(response);
  //         }
  //       })
  //       // console.log(customer);
  //       // setTimeout(function(){
  //       $('#first_name_value').prop('disabled', false);
  //       $('#email_value').prop('disabled', false);
  //       $('#phone_value').prop('disabled', false);
  //       $('#msg_value').prop('disabled', false);
  //
  //       $('#first_name_value').val(customer.name);
  //       $('#email_value').val(customer.email);
  //       $('#phone_value').val('');
  //       $('#msg_value').val('');
  //
  //       $('#first_name_value').focus();
  //       // },2000)
  //
  //     })
  //
  //   }else{
  //     // console.log('libera_false')
  //     $('#first_name_value').prop('disabled', true);
  //     $('#email_value').prop('disabled', true);
  //     $('#phone_value').prop('disabled', true);
  //     $('#msg_value').prop('disabled', true);
  //
  //     $('#first_name_value').val('Informe o CPF');
  //     $('#email_value').val('Informe o CPF');
  //     $('#phone_value').val('Informe o CPF');
  //     $('#msg_value').val('Informe o CPF');
  //     $('#msg_value').val('Informe o CPF');
  //   }
  //
  // }
  //
  // function validateName(){
  //   const path = `/customer/${customer.id}/?token=`;
  //
  //   const url = `${apiURL}${path}${token}`;
  //
  //   let name = $('#first_name_value').val();
  //
  //   // console.log(url);
  //   $.ajax({
  //       method: "PUT",
  //       url: url,
  //       data: { name: name }
  //     })
  //     .done(function( response ) {
  //       // console.log(response);
  //     });
  // }
  //
  // function validateEmail(){
  //   $('#email_value_error').hide();
  //   const path = `/customer/${customer.id}/?token=`;
  //
  //   const url = `${apiURL}${path}${token}`;
  //
  //   let email = $('#email_value').val();
  //
  //   // console.log(url);
  //   $.ajax({
  //       method: "PUT",
  //       url: url,
  //       data: { email: email }
  //     })
  //     .done(function( response ) {
  //
  //       // console.log(response);
  //     })
  //     .error(function(response){
  //       // console.log(response.responseJSON.errors);
  //       $('#email_value').focus();
  //       $('#email_value_error').show();
  //       $('#email_value_error').html(response.responseJSON.errors[0]);
  //     })
  // }

  // function addPhone(){
  //   $('#phone_value_error').hide();
  //   const path = `/customer/${customer.id}/?token=`;
  //
  //   const url = `${apiURL}${path}${token}`;
  //
  //   let tel = $('#phone_value').val();
  //
  //   console.log(tel.length);
  //   if(tel.length < 14){
  //     $('#phone_value_error').show();
  //     $('#phone_value_error').html('Telefone inválido');
  //   }else{
  //     $.ajax({
  //         method: "PUT",
  //         url: url,
  //         data: { tel: tel }
  //       })
  //       .done(function( response ) {
  //
  //         // console.log(response);
  //       })
  //       .error(function(response){
  //         // console.log(response.responseJSON.errors);
  //         $('#phone_value').focus();
  //         $('#email_value_error').show();
  //         $('#email_value_error').html(response.responseJSON.errors[0]);
  //       })
  //   }
  // }
  //
  // function addObservation(){
  //   const path = `/customer/${customer.id}/?token=`;
  //
  //   const url = `${apiURL}${path}${token}`;
  //
  //   let observation = $('#observation_value').val();
  //   if(observation.length > 1){
  //     $.ajax({
  //         method: "PUT",
  //         url: url,
  //         data: { observation: observation }
  //       })
  //       .done(function( response ) {
  //
  //         // console.log(response);
  //       })
  //   }
  // }

  function send_to_step_2(){
    $('a[href="#step_two"]').tab('show')
    $('a[href="#step_two"]').addClass('active')
    $('a[href="#step_one"]').removeClass('active')
  }

  function send_to_step_3(){
    $('a[href="#step_three"]').tab('show')
    $('a[href="#step_three"]').addClass('active')
    $('a[href="#step_two"]').removeClass('active')
  }

  function enviaForm(){
    $('#step_four').show()
    $('#step_three').hide('active')
  }

  // $(function(){


  // })

  (function($) {
    "use strict";

    $('#cpf_value_error').hide();
    $('#email_value_error').hide();
    $('#phone_value_error').hide();
    $('#filesList').hide();

    $('[money-mask]').mask("#.##0,00", {reverse: true});
    $('[cpf-mask]').mask("000.000.000-00");
    $('[tel-mask]').mask("(00) 00000-0000");


    $('#first_name_value').prop('disabled', true);
    $('#email_value').prop('disabled', true);
    $('#phone_value').prop('disabled', true);
    $('#msg_value').prop('disabled', true);

    $('#first_name_value').val('Informe o CPF');
    $('#email_value').val('Informe o CPF');
    $('#phone_value').val('Informe o CPF');
    $('#msg_value').val('Informe o CPF');


    $(document).ready(function() {
      $('.form-navigation-unit').click(function(e){

        e.preventDefault();
        validateFirstStep();

        if(!$(this).hasClass('active')) {
          $('.form-navigation-unit').removeClass('active');
          $(this).addClass('active');

          var tab = $(this).data('tab');

          $('.form-content-unit').slideUp();

          $('#'+tab).slideDown();
        }
      })

      var i = 1;

      // $('.stm-plus').click(function(e){
      // 	e.preventDefault();
      // 	if(i < 5) {
      // 		i++;
      // 		$('.upload-photos').append('<div class="stm-pseudo-file-input generated"><div class="stm-filename"><?php esc_html_e('Choose file...', 'motors'); ?></div><div class="stm-plus"></div><input class="stm-file-realfield" type="file" name="gallery_images_' + i + '"/></div>');
      // 	}
      // })

      // $('body').on('click', '.generated .stm-plus', function(){
      // 	i--;
      // 	$(this).closest('.stm-pseudo-file-input').remove();
      // })

      $('#step_two').click(function(){
        console.log('teste')
      })

      // var customer_id = customer.id;
      // var pathUpload = `/customer/file/${customer_id}/?token=`;
      // var urlUpload = `${apiURL}${pathUpload}${token}`;
      // $('#fileupload').click(function(){
      // 	// console.log('clicou')
      // 	// console.log(customer_id)
      // 	customer_id = $('#customer_id').val();
      // 	// console.log(customer_id)
      // 	// console.log(pathUpload);
      // 	pathUpload = `/customer/file/${customer_id}/?token=`;
      // 	// console.log(pathUpload);
      // 	urlUpload = `${apiURL}${pathUpload}${token}`;
      // 	$('#fileupload').fileupload('destroy');
      // 	$('#fileupload').fileupload({
      // 	    url: urlUpload,
      // 	    sequentialUploads: true
      // 	})
      // })
      // .success(function (result, textStatus, jqXHR) {
      // 	console.log(result);
      // })
      //   .error(function (jqXHR, textStatus, errorThrown) {
      //   	console.log(jqXHR);
      //   })
      //   .complete(function (result, textStatus, jqXHR) {
      //   	console.log(result);
      //   });



    })

  })(jQuery);
</script>


