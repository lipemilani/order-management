<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private Customer $customer;
    private Product $product;
    private Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Customer $customer, Product $product, Order $order)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("comerc_challenge@test.com", "comerc_challenge"),
            subject: 'Create Orders',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_details',
            with: [
                'customer' => $this->customer,
                'product' => $this->product,
                'order' => $this->order,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
