
import React from 'react';
import { cn } from '@/lib/utils';
import SocialIcons from './SocialIcons';

const Footer = () => {
  return (
    <footer className="tw-w-full tw-px-6 lg:tw-px-12 tw-py-10 tw-bg-white tw-border-t tw-border-gray-100">
      <div className="tw-max-w-7xl tw-mx-auto">
        <div className="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-center">
          {/* Logo and Description */}
          <div className="tw-mb-8 md:tw-mb-0 tw-text-center md:tw-text-left">
            <div className="tw-inline-flex tw-items-center tw-justify-center tw-bg-primary tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-font-bold tw-text-xl tw-mb-3">
              TINPED SMM
            </div>
            <p className="tw-text-gray-600 tw-max-w-md tw-text-sm">
              Premium social media marketing services designed to enhance your online presence and boost engagement across all major platforms.
            </p>
            <div className="tw-mt-4">
              <SocialIcons />
            </div>
          </div>
          
          {/* Navigation Links */}
          <div className="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 tw-gap-8 sm:tw-gap-16">
            <div>
              <h4 className="tw-font-semibold tw-text-gray-900 tw-mb-3">Company</h4>
              <ul className="tw-space-y-2">
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">About Us</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Our Services</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Contact</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Blog</a></li>
              </ul>
            </div>
            <div>
              <h4 className="tw-font-semibold tw-text-gray-900 tw-mb-3">Support</h4>
              <ul className="tw-space-y-2">
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Help Center</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">FAQs</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Privacy Policy</a></li>
                <li><a href="#" className="tw-text-gray-600 hover:tw-text-primary tw-transition-colors">Terms of Service</a></li>
              </ul>
            </div>
            <div className="tw-col-span-2 md:tw-col-span-1">
              <h4 className="tw-font-semibold tw-text-gray-900 tw-mb-3">Contact Us</h4>
              <ul className="tw-space-y-2">
                <li className="tw-text-gray-600">support@tinped.com</li>
                <li className="tw-text-gray-600">+1 (234) 567-8900</li>
                <li className="tw-text-gray-600">Live Chat: 24/7</li>
              </ul>
            </div>
          </div>
        </div>
        
        {/* Copyright */}
        <div className="tw-mt-10 tw-pt-6 tw-border-t tw-border-gray-100 tw-text-center">
          <p className="tw-text-gray-500 tw-text-sm">
            TINPED SMM Copyright 2024 - All rights reserved
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
