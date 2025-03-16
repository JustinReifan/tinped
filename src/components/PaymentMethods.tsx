
import React from 'react';
import { cn } from '@/lib/utils';
import { CreditCard } from 'lucide-react';

// Payment method data
const paymentMethods = [
  {
    id: 1,
    name: "Visa",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-visa-3-226460.png"
  },
  {
    id: 2,
    name: "Mastercard",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-mastercard-3-226462.png"
  },
  {
    id: 3,
    name: "PayPal",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-paypal-58-226444.png"
  },
  {
    id: 4,
    name: "Bitcoin",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-bitcoin-4-225686.png"
  },
  {
    id: 5,
    name: "Google Pay",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-google-pay-2038779-1721670.png"
  },
  {
    id: 6,
    name: "Apple Pay",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-apple-pay-2038781-1721672.png"
  },
  {
    id: 7,
    name: "Bank Transfer",
    image: "https://cdn.iconscout.com/icon/premium/png-256-thumb/bank-transfer-2-837018.png"
  },
  {
    id: 8,
    name: "Ethereum",
    image: "https://cdn.iconscout.com/icon/free/png-256/free-ethereum-1-283135.png"
  }
];

const PaymentMethodCard = ({ method }) => {
  return (
    <div className="tw-bg-white tw-rounded-xl tw-p-4 tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-50 hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-flex tw-flex-col tw-items-center tw-justify-center">
      <div className="tw-w-12 tw-h-12 tw-relative tw-mb-2">
        {method.image ? (
          <img 
            src={method.image} 
            alt={method.name}
            className="tw-w-full tw-h-full tw-object-contain"
          />
        ) : (
          <CreditCard className="tw-w-full tw-h-full tw-text-primary" />
        )}
      </div>
      <p className="tw-text-sm tw-font-medium tw-text-gray-700">{method.name}</p>
    </div>
  );
};

const PaymentMethods = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden">
      {/* Background Elements */}
      <div className="tw-absolute tw-bottom-20 -tw-left-20 tw-w-40 tw-h-40 tw-bg-primary-200 tw-rounded-full tw-filter tw-blur-[80px] tw-opacity-40 tw-animate-float" style={{ animationDelay: '0.5s' }}></div>
      
      <div className="tw-max-w-7xl tw-mx-auto">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Payment Methods</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Multiple <span className="text-gradient">Secure Payment</span> Options
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Choose from a variety of trusted payment methods for your convenience
          </p>
        </div>
        
        {/* Payment Methods Grid */}
        <div className="tw-grid tw-grid-cols-2 sm:tw-grid-cols-4 lg:tw-grid-cols-8 tw-gap-4">
          {paymentMethods.map(method => (
            <PaymentMethodCard key={method.id} method={method} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default PaymentMethods;
