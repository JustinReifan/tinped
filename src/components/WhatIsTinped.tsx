
import React from 'react';
import { cn } from '@/lib/utils';
import { ArrowRight } from 'lucide-react';

const WhatIsTinped = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden">
      {/* Background Elements */}
      <div className="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-60 tw-animate-float"></div>
      <div className="tw-absolute tw-bottom-20 -tw-left-10 tw-w-40 tw-h-40 tw-bg-primary-200 tw-rounded-full tw-filter tw-blur-[80px] tw-opacity-40 tw-animate-float" style={{ animationDelay: '1.5s' }}></div>
      
      <div className="tw-max-w-7xl tw-mx-auto">
        <div className="tw-flex tw-flex-col-reverse md:tw-flex-row tw-items-center tw-gap-8 lg:tw-gap-16">
          {/* Text Content */}
          <div className="tw-w-full md:tw-w-1/2 tw-space-y-6 tw-animate-fade-in">
            {/* Brand Badge */}
            <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-inline-flex tw-items-center tw-justify-center tw-border tw-border-primary-200">
              <span className="tw-text-primary tw-font-semibold tw-text-sm">TINPED SMM</span>
            </div>
            
            <h2 className="tw-text-3xl md:tw-text-4xl lg:tw-text-5xl tw-font-bold tw-text-gray-900">
              Apa itu <span className="text-gradient">TINPED SMM?</span>
            </h2>
            
            <p className="tw-text-base md:tw-text-lg tw-text-gray-600 tw-leading-relaxed">
            Tinped SMM adalah provider layanan Social Media Marketing (SMM) yang dirancang untuk membantu Anda meningkatkan performa media sosial secara optimal. Kami menyediakan layanan berkualitas tinggi untuk berbagai platform media sosial terpopuler (Instagram, Tiktok, dll).
            </p>
            
            <div className="tw-pt-4">
              <button className="btn-outline tw-text-base tw-flex tw-items-center tw-group">
                <span>Learn More</span>
                <ArrowRight className="tw-w-4 tw-h-4 tw-ml-2 tw-transition-transform tw-duration-300 group-hover:tw-translate-x-1" />
              </button>
            </div>
          </div>
          
          {/* Image Content */}
          <div className="tw-w-full md:tw-w-1/2 tw-flex tw-justify-center tw-items-center tw-relative">
            <div className="tw-relative tw-z-10 tw-animate-float" style={{ animationDuration: '6s' }}>
              {/* Phone Frame */}
              <div className="tw-relative tw-w-[280px] md:tw-w-[340px] tw-bg-gradient-to-br tw-from-gray-800 tw-to-gray-950 tw-rounded-[40px] tw-p-3 tw-shadow-glow-primary-lg">
                {/* Phone Screen */}
                <div className="tw-relative tw-bg-gradient-to-br tw-from-primary-100 tw-to-primary-300 tw-rounded-[32px] tw-overflow-hidden tw-aspect-[9/19]">
                  {/* 3D Elements floating out */}
                  <div className="tw-absolute -tw-right-6 tw-top-1/4 tw-w-12 tw-h-12 tw-bg-primary-500 tw-rounded-lg tw-shadow-lg tw-animate-float" style={{ animationDuration: '8s', zIndex: 20 }}></div>
                  <div className="tw-absolute -tw-left-8 tw-top-1/3 tw-w-16 tw-h-16 tw-bg-gradient-to-br tw-from-primary-400 tw-to-primary-600 tw-rounded-full tw-shadow-lg tw-animate-float" style={{ animationDuration: '7s', animationDelay: '1s', zIndex: 20 }}></div>
                  <div className="tw-absolute tw-right-10 tw-bottom-1/4 tw-w-14 tw-h-14 tw-bg-gradient-to-br tw-from-primary-300 tw-to-primary-500 tw-rounded-lg tw-rotate-12 tw-shadow-lg tw-animate-float" style={{ animationDuration: '9s', animationDelay: '0.5s', zIndex: 20 }}></div>
                  
                  {/* Phone Content */}
                  <div className="tw-absolute tw-inset-0 tw-p-4 tw-flex tw-flex-col tw-gap-3">
                    <div className="tw-w-full tw-h-2 tw-bg-white/20 tw-rounded-full"></div>
                    <div className="tw-w-2/3 tw-h-8 tw-bg-white/30 tw-rounded-lg tw-mt-2"></div>
                    <div className="tw-w-full tw-h-20 tw-bg-white/20 tw-rounded-lg tw-mt-2"></div>
                    <div className="tw-flex tw-gap-2 tw-mt-2">
                      <div className="tw-w-1/3 tw-h-16 tw-bg-white/30 tw-rounded-lg"></div>
                      <div className="tw-w-1/3 tw-h-16 tw-bg-white/20 tw-rounded-lg"></div>
                      <div className="tw-w-1/3 tw-h-16 tw-bg-white/30 tw-rounded-lg"></div>
                    </div>
                    <div className="tw-w-full tw-h-12 tw-bg-white/20 tw-rounded-lg tw-mt-2"></div>
                    <div className="tw-w-2/3 tw-h-10 tw-bg-primary-500 tw-rounded-lg tw-mt-2 tw-self-center"></div>
                  </div>
                </div>
                
                {/* Phone Home Button */}
                <div className="tw-w-1/3 tw-h-1 tw-bg-gray-500 tw-rounded-full tw-mx-auto tw-mt-2"></div>
              </div>
              
              {/* Shadow beneath phone */}
              <div className="tw-absolute tw-bottom-0 tw-left-1/2 tw-transform -tw-translate-x-1/2 tw-w-3/4 tw-h-4 tw-bg-black/20 tw-filter tw-blur-md tw-rounded-full"></div>
            </div>
            
            {/* Glow behind phone */}
            <div className="tw-absolute tw-w-[220px] tw-h-[220px] md:tw-w-[300px] md:tw-h-[300px] tw-rounded-full tw-bg-primary-500/20 tw-filter tw-blur-[60px]"></div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WhatIsTinped;
