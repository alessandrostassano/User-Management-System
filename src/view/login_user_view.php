

<?php include './src/view/head.php' ?> 
<?php include './src/view/header.php'?>




<div class="container">

<form action="">
            <div class="form-group">
               <label for="">email</label>
               <input
                value="<?= $email ?>" 
                class="form-control <?= $emailClass ?>"  
                name="email"  
                type="text">
               <div class="<?= $emailClassMessage ?>">
                  <?= $emailMessage ?>
               </div> 
            </div>

            <div class="form-group">
               <label for="">Password</label>
               <!-- is-invalid  -->
               <input
                value="<?= $password ?>" 
                class="form-control <?= $emailClass ?>"  
                name="email"  
                type="text">
               <div class="<?= $emailClassMessage ?>">
                  <?= $emailMessage ?>
               </div> 
            </div>


            <button class="btn btn-primary mt-3" type="submit"><?= $submit ?></button>
</form>
</div>

