
@extends('layouts.index')



@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">

                <div class="col-md-12 clearfix">
                    <div class="bill-to">
                        <p>Shipping/Bill To</p>
                        <div class="form-one">
                            <form  action="{{ route('CreateNewOrder') }}" action="post">
                                {{csrf_field()}}                                
                                <input type="text" name="first_name" placeholder="First Name *">
                                <input type="text" name="last_name" placeholder="Last Name">
                                <input type="text" name="email" placeholder="Email*">
                                <input type="text" name="phone" placeholder="Phone Number">
                                <input type="text" name="address" placeholder="Address*">                              

                                <select name="country" class="mb-10">
                                    <option>-- Country --</option>
                                    <option value="US">United States</option>
                                </select>
                                <select name="state" class="mb-10">
                                    <option>-- State / Province / Region --</option>
                                    <option value="CA">California</option>
                                </select>
                                
                                <input type="text" name="zip" placeholder="Zip / Postal Code *">
                                

                                <button class="btn btn-default check_out" type="submit" name="submit">Proceed To Payment</button>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>




    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        
    </div>
</section><!--/#do_action-->


@endsection


