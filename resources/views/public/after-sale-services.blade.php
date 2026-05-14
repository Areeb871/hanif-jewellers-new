@extends('public.layouts.header_latest')

@section('content')
    <section class="afterSaleServiceSection p-5">

    </section>

    <section class="m-3 mx-md-5 my-md-5">
        <div class="container py-4">
            <h2 class="pb-4 mb-3 text-center title text-black text-uppercase border-bottom border-black">
                After Sales Services
            </h2>

            <p class="text-center mb-5">
                Our commitment is to provide you with the highest level of jewellery care services. Our Experts at HANIF stores will be delighted to offer you advice and services to personalize your jewels, restore them or simply preserve their beauty and longevity. Should you have any questions or need more information regarding our services, we invite you to contact our Customer Service team or visit one of our HANIF Stores.
            </p>

            <style>
                /* Make accordion items taller and text larger */
                .accordion .accordion-button {
                    min-height: 60px;
                    font-size: 1.0rem;
                    font-weight: 700;
                    padding-top: 18px;
                    padding-bottom: 18px;
                    background-color: transparent !important;
                    color: inherit;
                }
                .accordion .accordion-item {
                    min-height: 60px;
                    border: none !important;
                }
                .accordion .accordion-body {
                    font-size: 0.9rem;
                    padding: 1.5rem 1.25rem;
                    border-top: 1px solid #0000; /* Keep inner border */
                }
                .accordion .accordion-button,
                .accordion .accordion-button:focus,
                .accordion .accordion-button:not(.collapsed) {
                    border: none !important;
                    box-shadow: none !important;
                    background-color: transparent !important;
                    color: inherit;
                }
                .accordion .accordion-collapse {
                    border: none !important;
                }
                /* Add border between accordion items */
                .accordion .accordion-item + .accordion-item {
                    border-top: 1px solid #dee2e6 !important;
                }
            </style>

            <div class="accordion" id="afterSalesAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            CLEANING & POLISHING
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#afterSalesAccordion">
                        <div class="accordion-body">
                            We recommend that you bring your jewels to a Hanif boutique annually to have them checked and restored to their original splendor. After a careful inspection of the jewel and based on its characteristics and conditions, our experts may recommend simple cleaning, ultrasonic cleaning or polishing, to remove superficial scratches and preserve its shine and longevity. For jewels in white gold, the polishing service includes rhodium plating, where applicable, to enhance the brilliance of the metal. For each service performed, a professional quality inspection ensures that every stone is safely set and that functional parts, such as clasps and safety locks, work properly.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ENGRAVING
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#afterSalesAccordion">
                        <div class="accordion-body">
                            Your Hanif jewel can be personalized by engraving a name, a date or a message on the precious metal (service subject to technical constraints and space availability). Performed by a jeweller, engraving is a discretionary service offered by your Hanif Store if requested at time of purchase or within one month of purchase.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            RE-SIZING
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#afterSalesAccordion">
                        <div class="accordion-body">
                            Performed on a bracelet, necklace, chain or ring, this service consists of increasing or reducing the size of the item within limitations and without affecting its aesthetic, comfort and quality. Some jewels, due to their unique design, cannot be re-sized. Please refer to our Hanif Boutiques for advice and resizing specifications for each model.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            EARRING
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#afterSalesAccordion">
                        <div class="accordion-body">
                            Your earring clips can be adjusted for better comfort. The adjustment increases or decreases the clip tension and gap, and therefore the hold on the earlobe. Posts can be added or removed on most models.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            REPAIR
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#afterSalesAccordion">
                        <div class="accordion-body">
                            Your jewel is a precious creation. Proper care in its use and handling will preserve its shine over time. If your jewel suffers a shock or hit, or if you see any signs of damage, you should refrain from wearing it until you have had it examined by an expert in one of our Hanif Stores. Our experts will take care of your jewel, carefully inspecting the stone setting, clasp functionality and aesthetic details. Missing components may be replaced and broken parts may be repaired or reconstructed to restore the beauty of your Hanif jewel. Once the type of service that needs to be carried out has been assessed, you will receive a quotation. Upon your acceptance, the service will be carried out as quickly as possible.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
