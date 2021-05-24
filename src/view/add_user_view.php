<?php

use sarassoroberto\usm\model\InteresseModel;

include './src/view/head.php' ?>
<?php include './src/view/header.php' ?>

<div class="container">

   <?php if (isset($msg)) : ?>

      <div class="alert alert-danger m-4"><?= $msg ?></div>

   <?php endif ?>


   <form class="mt-4" action="<?= $action ?>" method="POST">
      <div class="form-group">
         <label for="">Nome</label>
         <input value="<?= $firstName ?>" class="form-control <?= $firstNameClass ?>" name="firstName" type="text">
         <div class="<?= $firstNameClassMessage ?>">
            <?= $firstNameMessage ?>
         </div>
      </div>

      <div class="form-group">
         <label for="">Cognome</label>
         <input value="<?= $lastName ?>" class="form-control <?= $lastNameClass ?>" name="lastName" type="text">
         <div class="<?= $lastNameClassMessage ?>">
            <?= $lastNameMessage ?>
         </div>
      </div>


      <div class="form-group">
         <label for="">email</label>

         <input value="<?= $email ?>" class="form-control <?= $emailClass ?>" name="email" type="text">
         <div class="<?= $emailClassMessage ?>">
            <?= $emailMessage ?>
         </div>
      </div>

      
      <pre>
      </pre>

      <?php 
      $interesseModel = new InteresseModel();
      foreach($interesseModel->readAll() as $interesse ){ ?>
      <label for="">interessi</label>   
      <pre></pre>
        <div class="form-group">
         <div class="checkbox">
            <div class="checkbox">
               <label><input type="checkbox" value="" name='interessi'> <?= $interesse->getNome() ?> </label>
            </div>
         </div>
      </div> 
      <?php } ?>
      
      

         <pre>
         </pre>

      <div class="form-group">
         <label for="">data di nascita</label>
         <input class="form-control <?= $birthdayClass ?>" value="<?= $birthday ?>" name="birthday" type="date">
         <div class="<?= $birthdayClassMessage ?>">
            <?= $birthdayMessage ?>
         </div>
      </div>



      <?php if (empty($userId)) : ?>
         <div class="form-group">
            <label for="">password</label>
            <input class="form-control <?= $passwordClass ?>" value="<?= $password ?>" name="password" type="text">
            <div class="<?= $passwordClassMessage ?>">
               <?= $passwordMessage ?>
            </div>
         </div>
      <?php endif ?>

      <?php if (isset($userId)) { ?>

         <div class="form-group mt-4 p-4 border border-danger">
            <label class="text-danger">
               Questo campo è visibile motivi didattici in realtà dovrebbe essere un <b>input[type=hidden]</b> <br>
               serve a inviare via POST, il valore dello <b>userId</b> dell'istanza di User da aggiornare sul database<br>
            </label>
            <label class="d-block text-bold">id dell'utente che sto modificando</label>
            <input type="text" name="userId" value="<?= $userId ?>" class="form-control">
         </div>

      <?php } ?>

      <button class="btn btn-primary mt-3" type="submit"><?= $submit ?></button>
   </form>
</div>

</body>

</html>

