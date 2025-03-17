
import React from 'react';
import { cn } from '@/lib/utils';
import { CheckCircle2, XCircle } from 'lucide-react';

// Comparison data
const comparisonPoints = [
  {
    feature: "Service Quality",
    tinped: "High-quality, real-looking engagement",
    competition: "Low-quality, bot-like engagement"
  },
  {
    feature: "Delivery Speed",
    tinped: "Instant to 24hr delivery based on order size",
    competition: "Unpredictable, often delayed delivery times"
  },
  {
    feature: "Customer Support",
    tinped: "24/7 dedicated support team",
    competition: "Limited or no customer support"
  },
  {
    feature: "Refill Guarantee",
    tinped: "30-day auto refill if drops occur",
    competition: "No refill guarantee or complicated process"
  },
  {
    feature: "Price Transparency",
    tinped: "Clear pricing with no hidden fees",
    competition: "Hidden fees and unclear pricing models"
  },
  {
    feature: "Order Management",
    tinped: "Real-time order tracking and reporting",
    competition: "Limited or no order tracking capabilities"
  }
];

const DifferenceSection = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden">
      {/* Background Elements */}
      <div className="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-40 tw-animate-float"></div>
      <div className="tw-absolute tw-bottom-40 -tw-right-20 tw-w-40 tw-h-40 tw-bg-primary-200 tw-rounded-full tw-filter tw-blur-[80px] tw-opacity-50 tw-animate-float" style={{ animationDelay: '1s' }}></div>
      
      <div className="tw-max-w-7xl tw-mx-auto">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">What Makes Us Different</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Why is <span className="text-gradient">TINPED SMM</span> Unique?
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            A comparative list of what TINPED SMM offers vs Competition
          </p>
        </div>
        
        {/* Comparison Card with Glowing Border */}
        <div className="tw-relative tw-group">
          {/* Glowing border effect */}
          <div className="tw-absolute tw-inset-0 tw-rounded-xl tw-bg-gradient-to-r tw-from-primary-300 tw-via-primary-400 tw-to-primary-300 tw-opacity-0 group-hover:tw-opacity-70 tw-blur-[8px] tw-transition-opacity tw-duration-300"></div>
          
          {/* Card content */}
          <div className="tw-bg-white tw-rounded-xl tw-shadow-lg tw-border tw-border-primary-100 tw-overflow-hidden tw-relative tw-z-10">
            {/* Card Header */}
            <div className="tw-grid tw-grid-cols-3 tw-gap-0 tw-bg-gray-50 tw-border-b tw-border-gray-200">
              <div className="tw-py-4 tw-px-6 tw-font-semibold tw-text-gray-700">Feature</div>
              <div className="tw-py-4 tw-px-6 tw-font-semibold tw-text-primary">TINPED SMM</div>
              <div className="tw-py-4 tw-px-6 tw-font-semibold tw-text-gray-700">Competition</div>
            </div>
            
            {/* Comparison Rows */}
            <div className="tw-divide-y tw-divide-gray-200">
              {comparisonPoints.map((point, index) => (
                <div key={index} className="tw-grid tw-grid-cols-3 tw-gap-0 hover:tw-bg-gray-50 tw-transition-colors tw-duration-200">
                  <div className="tw-py-4 tw-px-6 tw-text-gray-800 tw-font-medium">{point.feature}</div>
                  <div className="tw-py-4 tw-px-6 tw-text-gray-700 tw-flex tw-items-center">
                    <CheckCircle2 className="tw-text-green-500 tw-w-5 tw-h-5 tw-flex-shrink-0 tw-mr-2" />
                    <span>{point.tinped}</span>
                  </div>
                  <div className="tw-py-4 tw-px-6 tw-text-gray-700 tw-flex tw-items-center">
                    <XCircle className="tw-text-red-500 tw-w-5 tw-h-5 tw-flex-shrink-0 tw-mr-2" />
                    <span>{point.competition}</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default DifferenceSection;
