<?php
    $title='Add User';
    $userid=0;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>        
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
   
    <?= $this->Html->css('add.css') ?>
    <?= $this->Html->css("https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"); ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script>
        $(document).ready(function(e){

            $('.goto_page2').click(function(e){
                var form=$('.step_1');
                console.log(form.serialize());
                e.preventDefault();
                $.ajax({        
                    url:'add',
                    type:"POST",
                    data: form.serialize(),
                    // dataType: 'json',
                    success:function(data)
                    {
                        var user_details=JSON.parse(data);
                        if (user_details.success) {
                            $('.user_id').val(user_details.user_id);
                            console.log($('.user_id').val());
                            $('#step_1').hide();
                            // $('#step_3').hide(); 
                            $('#step_2').show();
                        }
                        else{
                            alert('Error! Please enter your details again');
                        }
                    },
                    error: function(err) {
                        alert(err);
                    }
                 });

            $('.goto_page3').click(function(e){
                var form=$('.step_2');
                console.log(form.serialize());
                e.preventDefault();
                $.ajax({        
                    url:'add',
                    type:"POST",
                    data: form.serialize(),
                    // dataType: 'json',
                    success:function(data)
                    {
                        var user_details=JSON.parse(data);
                        if (user_details.success) {
                            $('.user_id').val(user_details.user_id);
                            console.log($('.user_id').val());
                            // $('#step_1').hide();
                            $('#step_2').hide(); 
                            $('#step_3').show();
                        }
                        else{
                            alert('Error! Please enter your details again');
                        }
                    },
                    error: function(err) {
                        alert(err);
                    }
                 });
            });
        });
        $('.submit').click(function(e){
            var form=$('.step_3');
            console.log(form.serialize());
            e.preventDefault();
            $.ajax({        
                url:'add',
                type:"POST",
                data: form.serialize(),
                success:function(data)
                {
                    var user_details=JSON.parse(data);
                    if (user_details.success) {
                        $('#step_1').hide();
                        $('#step_2').hide();
                        $('#step_3').hide();
                        $('#success_page').show();
                    }
                    else{
                        alert('Error! Please enter your details again');
                    }
                },
                error: function(err) {
                    alert(err);
                }
            });            
        });
    });
    </script>
</head>
<body>
    
    <div class="container" id="step_1">
        <div class="users large-2 medium-3 small-4 columns content">
        </div> 
        <div class="users form large-8 medium-6 small-4 columns content" id="step1">
            <?= $this->Form->create($user,
            ['class' => 'step_1']) ?>
            <fieldset>
                <legend><?= __('Step 1') ?></legend>
                <?php
                    echo $this->Form->hidden('step',['default' => 'Step1']);
                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="input {{type}}{{required}}">
                            {{content}} <span class="email_help">{{email_help}}</span></div>'
                    ]); 
                    echo $this->Form->control('email',[
                       'templateVars' => ['email_help' => '']]);
                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="input {{type}}{{required}}">
                            {{content}} <span class="password_help">{{password_help}}</span></div>'
                    ]);
                    echo $this->Form->control('password',[
                        'templateVars' => ['password_help' => 'At least 8 characters long']]);
                    echo $this->Form->button('Next',['class'=>'goto_page2 btn btn-info']);
                ?>
            </fieldset>
            <?= $this->Form->end() ?>            
        </div>
        <div class="users large-2 medium-3 small-4 columns content">
        </div> 
    </div><br>

    <div class="container" id="step_2" style="display: none;">
        <div class="users large-2 medium-3 small-4 columns content">
        </div> 
        <div class="users form large-8 medium-6 small-4 columns content" id="step2" >
            <?= $this->Form->create($user,
            ['class' => 'step_2']) ?>
            <fieldset>
                <legend><?= __('Step 2') ?></legend>
                <?php
                    echo $this->Form->hidden('step',['default' => 'Step2']);
                    echo $this->Form->hidden('id',['class' => 'user_id']); 
                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="input {{type}}{{required}}">
                            {{content}} <span class="username_help">{{username_help}}</span></div>'
                    ]); 
                    echo $this->Form->control('username');
                    echo $this->Form->label('gender');
                    echo "<br>";
                    echo $this->Form->radio('gender', ['Male', 'Female']);
                    echo "<br>";
                    echo $this->Form->button('Next',['class'=>'goto_page3 btn btn-info']);
                ?>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
        <div class="users large-2 medium-3 small-4 columns content">
        </div> 
    </div><br>

    <div class="container" id="step_3" style="display: none;">
        <div class="users form large-2 medium-3 small-4 columns content">
        </div> 
        <div class="users form large-8 medium-6 small-4 columns content" id="step3">
            <?= $this->Form->create($user,
            ['class' => 'step_3']) ?>
            <fieldset>
                <legend><?= __('Step 3') ?></legend>
                <?php
                    echo $this->Form->hidden('step',['default' => 'Step3']); 
                    echo $this->Form->hidden('id',['class' => 'user_id']); 
                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="input {{type}}{{required}}">
                            {{content}} <span class="hobbies_help">{{hobbies_help}}</span></div>'
                    ]);
                    echo $this->Form->control('hobbies');
                    $this->Form->setTemplates([
                        'inputContainer' => '<div class="input {{type}}{{required}}">
                            {{content}} <span class="interests_help">{{interests_help}}</span></div>'
                    ]);
                    echo $this->Form->control('interests');
                    echo $this->Form->button('Submit',['class'=>'btn btn-success']);        
                ?>  
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
        <div class="users large-2 medium-3 small-4 columns content">
        </div>
    </div><br>
    
    <div class="container" id="success_page" style="display: none;">
        <h1>Your Details stored Successfully!</h1>
    </div>
</body>
</html>


