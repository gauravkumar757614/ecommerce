<div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.razorpay.payment') }}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('razorpay.key') }}"
                        data-amount="{{ 40 * 100 }}" data-buttontext="Pay with razorpay" data-name="test payment"
                        data-description="payment" data-prefill.name="user" data-prefill.email="user@gmail.com" data-theme.color="#ff7529">
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
