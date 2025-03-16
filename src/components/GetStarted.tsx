
import React from 'react';
import { cn } from '@/lib/utils';
import { UserPlus, Wallet, ListChecks, Package2 } from 'lucide-react';

const stepData = [
  {
    id: 1,
    title: 'Register an Account',
    icon: <UserPlus className="tw-w-8 tw-h-8 tw-text-primary-500" />,
    description: 'Create your account in less than a minute with email or social login. No verification needed.'
  },
  {
    id: 2,
    title: 'Top Up Balance',
    icon: <Wallet className="tw-w-8 tw-h-8 tw-text-primary-500" />,
    description: 'Add funds using multiple secure payment methods with instant credit to your account.'
  },
  {
    id: 3,
    title: 'Choose a Service',
    icon: <ListChecks className="tw-w-8 tw-h-8 tw-text-primary-500" />,
    description: 'Browse our wide range of services for all major social media platforms.'
  },
  {
    id: 4,
    title: 'Order and Monitor',
    icon: <Package2 className="tw-w-8 tw-h-8 tw-text-primary-500" />,
    description: 'Place your order and track its progress in real-time through your dashboard.'
  }
];

const StepCard = ({ step }) => {
  return (
    <div className="tw-group tw-relative tw-h-full">
      {/* Card */}
      <div className="tw-h-full tw-flex tw-flex-col tw-relative tw-z-10 tw-bg-white tw-rounded-xl tw-overflow-hidden tw-p-6 tw-border tw-border-primary-100 hover:tw-border-primary-300 tw-shadow-sm hover:tw-shadow-glow-primary tw-transition-all tw-duration-300">
        {/* Step Number Circle */}
        <div className="tw-absolute tw-top-4 tw-right-4 tw-w-8 tw-h-8 tw-rounded-full tw-bg-primary-100 tw-flex tw-items-center tw-justify-center">
          <span className="tw-text-primary-600 tw-font-semibold">{step.id}</span>
        </div>
        
        {/* Icon */}
        <div className="tw-mb-4">{step.icon}</div>
        
        {/* Content */}
        <h3 className="tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2">{step.title}</h3>
        
        {/* Description (hidden until hover) */}
        <p className="tw-mt-2 tw-text-gray-600 tw-opacity-0 tw-max-h-0 group-hover:tw-opacity-100 group-hover:tw-max-h-40 tw-transition-all tw-duration-300 tw-overflow-hidden">
          {step.description}
        </p>
      </div>
      
      {/* Card Background Glow (visible on hover) */}
      <div className="tw-absolute tw-inset-0 tw-bg-primary-50 tw-rounded-xl tw-scale-95 tw-opacity-0 group-hover:tw-scale-105 group-hover:tw-opacity-70 tw-transition-all tw-duration-300 tw-z-0"></div>
    </div>
  );
};

const GetStarted = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
      {/* Background Elements */}
      <div className="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
      <div className="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
      
      <div className="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Get Started</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Steps to Use <span className="text-gradient">TINPED SMM</span>
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Start boosting your social media presence in four simple steps
          </p>
        </div>
        
        {/* Cards Grid */}
        <div className="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-6">
          {stepData.map((step) => (
            <StepCard key={step.id} step={step} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default GetStarted;
