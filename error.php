<?php if(isset($_SESSION['alert'])){ ?>
<label>
    <div class="alert alert-danger">
        <?php 
        echo $_SESSION['alert']; 
        unset($_SESSION['alert']);
        ?>
    </div>
</label>

    </div>
</label>
<?php } ?>

<?php if(isset($_SESSION['success'])){ ?>
<label>
    <div class="alert text-success">
        <?php 
        echo $_SESSION['success']; 
        unset($_SESSION['success']);
        ?>
    </div>
</label>

    </div>
</label>
<?php } ?>