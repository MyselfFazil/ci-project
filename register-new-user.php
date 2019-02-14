<div class="row">
<?php
  $form_attributes = array(
    'id' => 'sign-up',
    'class' => ''
  );

  $first_name_lable = 'First name';
  $first_name_field = array(
    'id'        => 'firstname',
    'class'     => 'form-control',
    'name'      => 'firstname',
    'placeholder' => $first_name_lable,
    'maxlength' => '50',
    'size'      => '20',
    'value'     => set_value('firstname', '')
  );    

  $last_name_lable = 'Surname';
  $last_name_field = array(
    'id'        => 'surname',
    'class'     => 'form-control',
    'name'      => 'surname',
    'placeholder' => $last_name_lable,
    'maxlength' => '50',
    'size'      => '20',
    'value'     => set_value('surname', '')
  );    

  $email_lable = 'Email address';
  $email_field = array(
    'type'      => 'email',
    'id'        => 'emailaddress',
    'class'     => 'form-control',
    'name'      => 'emailaddress',
    'placeholder' => $email_lable,
    'maxlength' => '100',
    'size'      => '20',
    'value'     => set_value('emailaddress', '')
  );    

  $password_lable = 'Password';
  $password_field = array(
    'type'      => 'password',
    'id'        => 'password',
    'class'     => 'form-control',
    'name'      => 'password',
    'placeholder' => $password_lable,
    'maxlength' => '30',
    'size'      => '20',
  );
    //'class'     => 'custom-select custom-select-sm mb-3',

  $birthday_lable = 'Birthday';
  $birth_day_field = array(
    'id'    =>  'birthdate',
    'name'  =>  'birthdate',
  );

  $birth_month_field = array(
    'id'    =>  'birthmonth',
    'name'  =>  'birthmonth',
  );

  $birth_year_field = array(
    'id'    =>  'birthyear',
    'name'  =>  'birthyear',
  );


  $gender_field_1_attributes = array(
    'type'    => 'radio',
    'id'      => 'female',
    'class'   => 'custom-control-input',
    'name'    =>  'gender',
    'value'   =>  'female',
    'checked' =>  set_radio('gender', 'female')
  );  
  $gender_field_2_attributes = array(
    'type'    => 'radio',
    'id'      => 'male',
    'class'   => 'custom-control-input',
    'name'    => 'gender',
    'value'   => 'male',
    'checked' => set_radio('gender', 'male')
  );
  $gender_label_attributes = array(
    'class' => 'custom-control-label'
  );

  $captcha_field = array(
    'id' => 'captcha',
    'name' => 'captcha',
    'placeholder' => 'What code is in the image?',
  );

  $submit_field = array(
    'name' => 'signup',
    'value' => 'Sign up',
    'attributes' => array(
      'class' => 'btn btn-primary'
    )
  );

  $registration_link = array(
    'action'     =>  'myadmin/signup',
    'title'      =>  'Sign up',
    'attributes' =>  array(
        'title'  =>  'Sign up'
    )
  );

  $login_link = array(
    'action'     =>  'myadmin/login',
    'title'      =>  'Login',
    'attributes' =>  array(
        'title'  =>  'login'
    )
  );

  echo form_open('myadmin/signup', $form_attributes);
  echo form_fieldset('Sign up'); 
  ?>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <?php echo form_label($first_name_lable, $first_name_field['name']); ?>
          <?php echo form_input($first_name_field); ?>
          <?php echo form_error($first_name_field['name'], '<div class="error">', '</div>'); ?>
        </div>      
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <?php echo form_label($last_name_lable, $last_name_field['name']); ?>
          <?php echo form_input($last_name_field); ?>
          <?php echo form_error($last_name_field['name'], '<div class="error">', '</div>'); ?>
        </div>      
      </div>
    </div>
    <div class="form-group">
      <?php echo form_label($email_lable, $email_field['name']); ?>
      <?php echo form_input($email_field); ?>
      <?php echo form_error($email_field['name'], '<div class="error">', '</div>'); ?>
    </div>    
    <div class="form-group">
      <?php echo form_label($password_lable, $password_field['name']); ?>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <a href="#" id="show-pass" class="input-group-text"><i id="show-pass-icon" class="fa fa-eye"></i></a>
        </div>
        <?php echo form_input($password_field); ?>
      </div>
      <?php echo form_error($password_field['name'], '<div class="error">', '</div>'); ?>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <?php echo form_label($birthday_lable); ?>
          <?php 
            echo form_dropdown(
              $birth_day_field['name'], 
              $this->general->build_date_array('days'), 
              date('d'), 
              $birth_day_field
            ); 
          ?>
          <?php 
            echo form_dropdown(
              $birth_month_field['name'], 
              $this->general->build_date_array('months'), 
              date('m'), 
              $birth_month_field
            ); 
          ?>
          <?php 
            echo form_dropdown(
              $birth_year_field['name'], 
              $this->general->build_date_array('years'), 
              1994, 
              $birth_year_field
            ); 
          ?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-radio custom-control-inline">
        <?php echo form_radio($gender_field_1_attributes, $gender_field_1_attributes['value']); ?>
        <?php echo form_label($gender_field_1_attributes['id'], $gender_field_1_attributes['id'], $gender_label_attributes); ?>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <?php echo form_radio($gender_field_2_attributes, $gender_field_2_attributes['value']); ?>
        <?php echo form_label($gender_field_2_attributes['id'], $gender_field_2_attributes['id'], $gender_label_attributes); ?>
      </div> 
      <?php echo form_error($gender_field_2_attributes['name'], '<div class="error">', '</div>'); ?>
    </div> 
    <div class="form-group">
      <?php echo form_label('', $captcha_field['name']); ?> 
      <?php echo form_input($captcha_field); ?>
      <?php echo $captcha['image']; ?>
      <?php echo form_error($captcha_field['name'], '<div class="error">', '</div>'); ?>
    </div>

  <?php
  echo form_submit($submit_field['name'], $submit_field['value'], $submit_field['attributes']);
  echo form_fieldset_close();
  echo form_close();

  echo $this->session->flashdata('signup_response');

  ?>
</div>
<div class="row">
  <?php echo anchor($login_link['action'], $login_link['title'], $login_link['attributes']); ?>
</div>