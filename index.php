<?php include 'inc/header.php' ?>

<?php 
    $name = $description = $value = $pay_method = '';
    $name_error = $description_error = $value_error = $pay_method_error = '';

    if(isset($_POST['submit'])){
        // Name verification
        if(empty($_POST['name'])){
            $name_error = "Name is required";
        } else{
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if(empty($_POST['description'])){
            $description_error = "Description is required";
        } else{
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if(empty($_POST['value'])){
            $value_error = "Value is required";
        } else{
            $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_FLOAT);
        }
        
        if(empty($_POST['pay_method'])){
            $pay_method_error = "You need to select a payment method!";
        } else{
            $pay_method = filter_input(INPUT_POST, 'pay_method', FILTER_SANITIZE_NUMBER_INT);
        }

        if(empty($name_error) && empty($description_error) && empty($value_error) && empty($pay_method_error)){
            $sql = "INSERT INTO expenses (name, description, value, pay_method) 
            values('$name', '$description', '$value', '$pay_method')";

            if(mysqli_query($conn, $sql)){
                header('Location: list.php');
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }

        

    }
?>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="expense-form">
        <div>
            <h1>Expense</h1>
            <h4>Insert the expense information</h4>
        </div>
        <div class="form-fields">
            <input type="text" placeholder="Expense name" style="width: 14.6rem;" name="name">
        </div>
        <div class="form-fields">
            <textarea name="description" id="" cols="10" rows="5" placeholder="Description" style="width: 14.6rem; border-radius: 1rem;"></textarea>
        </div>
        <div style="display:flex; gap: 10px;">
            <div class="form-fields">
                <span style="font-weight: 800;">$</span><input type="text" style="width: 6rem;" name="value">
            </div>
            <div class="form-fields">
                <select name="pay_method" id="">
                    <option value="1">Credit card</option>
                    <option value="2">Pix</option>
                    <option value="3">Money</option>
                </select>
            </div>
        </div>

        <button type="submit" name="submit" class="btn-green btn-submit">Submit</button>
    </form>


<?php include 'inc/footer.php'; ?>