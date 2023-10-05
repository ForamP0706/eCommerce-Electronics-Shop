<?php include('includes/header.php');
include('includes/navbar.php');
?>
<div>   
<form>
<div class="row">
  <div class="form-group col my-3">
  <label for="FirstName">First Name :</label>
    <input type="text" class="form-control" placeholder="First name">
  </div>
  <div class="form-group col my-3">
  <label for="LastName">Last Name :</label>
    <input type="text" class="form-control" placeholder="Last name">
  </div>
</div>

<div class="row">
    <div class="form-group col my-3">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col my-3">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
    <div class="form-group col my-3">
      <label for="ConfirmPassword">Confirm Password</label>
      <input type="ConfirmPassword" class="form-control" id="ConfirmPassword" placeholder="ConfirmPassword">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="row">
    <div class="form-group col my-3">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col my-3">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col my-3">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="row">
  <div class="form-group col my-3">
  <button type="submit" class="btn btn-primary">Sign in</button></div>
</div>
</form>
</div>
<?php include('includes/footer.php');

?>