@extends('layouts.index')

@section('center')

<section id="cart_items">
    <div class="container">
        
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shipping Cart</li>
            </ol>
        </div><!--/breadcrums-->

      
        <div class="shopper-informations">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <div class="bill-to">
                        <p>Payment Info</p>
                        <div class="form-one">
                            <div class="total_area">
                                <ul>
                                    <li>Payment Status 
                                        @if($payment_info['status']=='on_hold')
                                        <span>Not Paid Yet</span>
                                        @endif
                                    </li>
                                    <li>Shipping Cost <span>Free</span></li>
                                    <li>Total <span>{{ $payment_info['price'] }}</span></li>
                                </ul>
                                <div class="payment_actions">
                                    <a href="" class="btn btn-default update">Update</a>
                                    <div id="paypal-button"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading"></div>        
    </div>
</section><!--/#do_action-->

<script src="https://www.paypal.com/sdk/js?client-id=AeC5WfDGLu_5MtRinCdbzjNeVyq--fjyFbF3n9_FXedbSipgdibvajXjSJoEsv4_Vf4yCoIkbetoOm8n"></script>


<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: "{{$payment_info['price']}}"
          }
        }]
      });
    },
    onApprove: function(data, actions) {

        // Authorize the transaction
        actions.order.authorize().then(function(authorization) {
            
            //Get the authorization id
            var authorizationID = authorization.purchase_units[0].payments.authorizations[0].id;
            
            // Call your server to validate and capture the transaction
            return fetch('./paymentreceipt', {
              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                orderID: data.orderID,
                authorizationID: authorizationID
              })
            });
        });
    }
  }).render('#paypal-button');
</script>


@endsection


