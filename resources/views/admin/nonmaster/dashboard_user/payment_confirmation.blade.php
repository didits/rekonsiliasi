@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
  @include('admin.master.navbar')
  <div class="main-panel">
    @include('admin.master.top_navbar')
    <?php if(trans('messages.currency') == 'USD') $currency = 0; else $currency=Swap::quote('USD/IDR').""; ?>
      <div class="content">
        <div class="container-fluid">
          <ul class="nav nav-tabs">
            <li class="active" ><a data-toggle="tab" href="#home">Payment Review</a></li>
            <li><a data-toggle="tab" href="#menu1">Payment Method</a></li>
            <li><a data-toggle="tab" href="#menu2">Terms and Conditions</a></li>
            <li><a data-toggle="tab" href="#menu2">Success</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <div class="card" style="margin-top: 20px">
                <div class="header">
                  <h4 class="title">1. Payment Review</h4>
                  <p class="category">Backend development</p>
                  <hr>
                </div>
                <div class="content">
                  <div class="table-full-width">
                    <table class="table">
                      <thead>
                        <tr>
                          <td style="padding-left:15px"><b>Name Tree</b></td>
                          <td><b>Price</b></td>
                          <td><b>Quantity</b></td>
                          <td class="text-right"><b>Subtotal</b></td>
                          <td><b>Remove</b></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach(Cart::content() as $row) :?>
                          <tr> 
                            <td><?php echo $row->name; ?></td>
                            <td><?php if(trans('messages.currency') == 'USD')
                             echo "$ ".number_format($row->price, 0, ',', '.')." (USD)";
                             else {                  
                               $money = $row->price * (float)$currency; 
                               echo "(IDR) ".number_format($money, 0, ',', '.');}?></td>
                               <td><?php echo $row->qty; ?></td>
                               <td class="text-right"><?php if(trans('messages.currency') == 'USD')
                                 echo "$ ".number_format($row->total, 0, ',', '.')." (USD)";
                                 else {                  
                                   $money = $row->total * (float)$currency; 
                                   echo "(IDR) ".number_format($money, 0, ',', '.');}?></td>
                                   <td style="width:20px" class="td-actions text-center">
                                    <button rowid="<?php echo $row->rowId;?>" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs remove_cart">
                                      <i class="fa fa-times"></i>
                                    </button>
                                  </td>
                                </tr>
                              <?php endforeach;?>
                              <tr>
                                <td colspan="3"><b class="grey-text">Subtotal</b></td>
                                <td class="text-right"><b class="grey-text">
                                  <?php if(trans('messages.currency') == 'USD')
                                  echo "$ ".number_format(Cart::subtotal(), 0, ',', '.')." (USD)";
                                  else {                  
                                   $money = Cart::subtotal() * (float)$currency; 
                                   echo "(IDR) ".number_format($money, 0, ',', '.');}?></b></td>
                                   <td></td>
                                 </tr>
                                 <tr>
                                  <td colspan="3"><b class="grey-text">Tax</b></td>
                                  <td class="text-right"><b class="grey-text">
                                    <?php if(trans('messages.currency') == 'USD')
                                    echo "$ ".number_format(Cart::tax(), 0, ',', '.')." (USD)";
                                    else {                  
                                     $money = Cart::tax() * (float)$currency; 
                                     echo "(IDR) ".number_format($money, 0, ',', '.');}?></b></td>
                                     <td></td>
                                   </tr>
                                   <tr>
                                    <td colspan="3"><b class="grey-text">Total</b></td>
                                    <td class="text-right"><b class="grey-text">
                                      <?php if(trans('messages.currency') == 'USD')
                                      echo "$ ".number_format(Cart::total(), 0, ',', '.')." (USD)";
                                      else {                  
                                       $money = Cart::total() * (float)$currency; 
                                       echo "(IDR) ".number_format($money, 0, ',', '.');}?></b></td>
                                       <td></td>
                                     </tr>
                                   </tbody>
                                 </table>
                               </div>                                
                             </div>
                           </div>
                         </div>
                         <div id="menu1" class="tab-pane fade">
                         <div class="card " style="margin-top: 20px">
                            <div class="header">
                              <h4 class="title">2. Payment Method</h4>
                              <p class="category">Choose your payment method</p>
                              <hr>
                            </div>
                            <div class="content" id="payment_method_id">
                              <label>
                                <input type="radio" name="name_payment_method" value="paypal" required="required" />
                                <img src="{{URL::asset('img/payment_method/paypal.png')}}" style="width:150px">
                              </label>

                              <label>
                                <input type="radio" name="name_payment_method" value="bank_transfer" required="required"/>
                                <img src="{{URL::asset('img/payment_method/bank_transfer.png')}}" style="width:150px">
                              </label>                              
                            </div>
                          </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                          <div class="card " style="margin-top: 20px">
                            <div class="header">
                              <h4 class="title">3. Terms and Conditions</h4>
                              <hr>
                            </div>
                            <div class="content">
                              <ul style="margin-left:-20px">
                                <li>
                                  The owner is entitled to report the progress of tree planting and maintenance of trees through a reporting system that is prepared in Taponesia
                                </li>
                                <li>
                                  Owners of trees from time to time have a right to physically see their own trees has.
                                </li>
                                <li>
                                  Owners get a tree for its fruit from trees when the trees were already started production and harvested.
                                </li>
                                <li>
                                  The average yield net per tree per season is the yields similar trees in the plots during one season after deducting the costs associated with harvesting, post-harvest management and sales, and divided by the number of similar trees in plots that concerned.
                                </li>
                                <li>
                                  At the end of the period of validity of the certificate which coincides with the expiry of the lease of the land where tree planting is concerned, the tree owner has the right to decide whether the certificate will be extended, the tree is sold to another party forwarded its ownership or diwakafkan for social and humanitarian interests.
                                </li>
                              </ul>
                              <br>
                              <label class="checkbox" id="term_and_condition_id">
                                <input type="checkbox" name="term_and_condition" value="accepted" data-toggle="checkbox" required="required">
                                I agree with term and conditions
                              </label>
                              <hr>
                              <button type="submit" class="btn btn-info btn-fill pull-right submit_payment">CHECK OUT</button>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- Modal -->
                  <div id="myModal" class="modal fade" role="dialog" style="position:fixed;z-index:2000">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content" >
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">There is something wrong!</h4>
                        </div>
                        <div class="modal-body">
                          <ul id="content_wrong">
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </div>
                      </div>

                    </div>
                  </div>

                  @include('admin.master.footer')
                  <form id="remove_cart" role="form" method="POST" action="{{ url('/remove_cart') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="row_id" id="row_id" value="">
                  </form>
                  <form id="submit_payment" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="payment_method" id="payment_method" value="">
                    <input type="hidden" name="agreement" id="agreement" value="">
                  </form>
                  <script type="text/javascript">

                    $(".remove_cart").on("click", function(){
                      var get_id_remove_botton = $(this).context.getAttribute("rowid");
                      console.log($(this).context.getAttribute("rowid"));
                      $("#row_id").val(get_id_remove_botton);
                      document.getElementById("remove_cart").submit();
                    });

                    $(".submit_payment").on("click", function(){
                      var payment_method = $('input[name=name_payment_method]:checked', '#payment_method_id').val();
                      var term_and_condition = $('input[name=term_and_condition]:checked', '#term_and_condition_id').val();
                      var error_message = "";
                      if(payment_method)
                        $('#payment_method').val(payment_method);
                      else
                        error_message = error_message + "<li>Please choose payment method</li>";

                      if(term_and_condition)
                        $('#agreement').val(term_and_condition);
                      else
                        error_message = error_message + "<li>Please agree with term and conditions</li>";

                      $('#content_wrong').html(error_message);

                      if(!payment_method || !term_and_condition)
                        $('#myModal').modal('show');
                      else
                        document.getElementById("submit_payment").submit();
                    });

                  </script>
                </div>
              </div>
              @endsection