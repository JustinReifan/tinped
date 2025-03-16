
import React, { useEffect, useRef } from 'react';
import { cn } from '@/lib/utils';
import LogoCarousel from './LogoCarousel';
import { ArrowRight } from 'lucide-react';

const Hero = () => {
  const headingRef = useRef<HTMLHeadingElement>(null);
  const subHeadingRef = useRef<HTMLParagraphElement>(null);
  const buttonContainerRef = useRef<HTMLDivElement>(null);
  
  useEffect(() => {
    const heading = headingRef.current;
    const subHeading = subHeadingRef.current;
    const buttonContainer = buttonContainerRef.current;
    
    // Apply animations with delay
    if (heading) {
      heading.style.opacity = '0';
      heading.style.transform = 'translateY(20px)';
      
      setTimeout(() => {
        heading.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        heading.style.opacity = '1';
        heading.style.transform = 'translateY(0)';
      }, 100);
    }
    
    if (subHeading) {
      subHeading.style.opacity = '0';
      subHeading.style.transform = 'translateY(20px)';
      
      setTimeout(() => {
        subHeading.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        subHeading.style.opacity = '1';
        subHeading.style.transform = 'translateY(0)';
      }, 300);
    }
    
    if (buttonContainer) {
      buttonContainer.style.opacity = '0';
      buttonContainer.style.transform = 'translateY(20px)';
      
      setTimeout(() => {
        buttonContainer.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        buttonContainer.style.opacity = '1';
        buttonContainer.style.transform = 'translateY(0)';
      }, 500);
    }
  }, []);

  return (
    <div className="tw-min-h-screen tw-relative tw-overflow-hidden tw-flex tw-flex-col tw-items-center tw-justify-center tw-px-4 sm:tw-px-6 lg:tw-px-12 tw-pt-16 sm:tw-pt-20 tw-pb-8 sm:tw-pb-10">
      {/* Background Elements - Optimized for all devices */}
      <div className="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:24px_24px] sm:tw-bg-[size:32px_32px] tw-opacity-60 tw-z-0"></div>
      <div className="tw-absolute tw-top-20 tw-left-1/2 tw-transform -tw-translate-x-1/2 tw-w-[150%] sm:tw-w-[130%] tw-h-[150%] tw-bg-gradient-radial tw-from-primary-100/50 tw-to-transparent tw-opacity-70 tw-pointer-events-none"></div>
      <div className="tw-absolute tw-top-40 -tw-left-20 tw-w-32 sm:tw-w-40 tw-h-32 sm:tw-h-40 tw-bg-primary-200 tw-rounded-full tw-filter tw-blur-[60px] sm:tw-blur-[80px] tw-opacity-60 tw-animate-float"></div>
      <div className="tw-absolute tw-bottom-20 sm:tw-bottom-40 -tw-right-10 sm:-tw-right-20 tw-w-40 sm:tw-w-60 tw-h-40 sm:tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[60px] sm:tw-blur-[80px] tw-opacity-30 tw-animate-float" style={{ animationDelay: '1s' }}></div>

      {/* Main Content - Responsive adjustments */}
      <div className="tw-max-w-7xl tw-mx-auto tw-flex tw-flex-col tw-items-center tw-justify-center tw-relative tw-z-10 tw-pt-8 sm:tw-pt-12 md:tw-pt-16">
        {/* Brand Badge - More visible on mobile */}
        <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 sm:tw-px-6 tw-py-1.5 sm:tw-py-2 tw-flex tw-items-center tw-justify-center tw-mb-4 sm:tw-mb-6 tw-border tw-border-primary-200 tw-animate-pulse-glow">
          <span className="tw-text-primary tw-font-semibold tw-text-sm sm:tw-text-base">TINPED SMM</span>
        </div>

        {/* Main Heading - Adjusted for all screen sizes */}
        <h1 
          ref={headingRef}
          className="tw-text-3xl sm:tw-text-4xl md:tw-text-5xl lg:tw-text-6xl tw-font-bold tw-text-center tw-mb-4 sm:tw-mb-6 tw-text-gray-900 tw-tracking-tight tw-px-2"
        >
          <span className="tw-block tw-text-balance">Boost Your Social Presence</span>
          <span className="tw-block text-gradient tw-text-balance tw-mt-1">With Premium SMM Services</span>
        </h1>

        {/* Sub Heading - Font size adjustments */}
        <p 
          ref={subHeadingRef}
          className="tw-text-base sm:tw-text-lg md:tw-text-xl tw-text-gray-600 tw-text-center tw-max-w-xl sm:tw-max-w-2xl tw-mb-6 sm:tw-mb-8 tw-leading-relaxed tw-px-2"
        >
          Get instant, high-quality engagement for all your social media platforms. Fast delivery, real engagement, 24/7 support.
        </p>

        {/* CTA Buttons - Responsive layout */}
        <div 
          ref={buttonContainerRef}
          className="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-gap-3 sm:tw-gap-4 tw-mb-12 sm:tw-mb-16 tw-w-full tw-justify-center"
        >
          <button className="tw-w-full sm:tw-w-auto btn-primary tw-text-sm sm:tw-text-base tw-py-2.5 sm:tw-py-3 tw-px-6 sm:tw-px-8 btn-glow tw-flex tw-items-center tw-justify-center">
            <span>Get Started</span>
            <ArrowRight className="tw-w-4 tw-h-4 tw-ml-2" />
          </button>
          <button className="tw-w-full sm:tw-w-auto btn-outline tw-text-sm sm:tw-text-base tw-py-2.5 sm:tw-py-3 tw-px-6 sm:tw-px-8 tw-flex tw-items-center tw-justify-center">
            Learn More
          </button>
        </div>

        {/* Logo Carousel - Full width on all devices */}
        <div className="tw-w-full tw-overflow-hidden">
          <LogoCarousel />
        </div>
      </div>
    </div>
  );
};

export default Hero;
