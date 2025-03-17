
import React from 'react';
import { Facebook, Instagram, Twitter, Youtube, Twitch, Linkedin, TiktokLogo, DribbbleLogo } from './SocialIcons';

const LogoCarousel = () => {
  const socialPlatforms = [
    { name: 'Facebook', icon: <Facebook className="tw-w-6 tw-h-6" /> },
    { name: 'Instagram', icon: <Instagram className="tw-w-6 tw-h-6" /> },
    { name: 'Twitter', icon: <Twitter className="tw-w-6 tw-h-6" /> },
    { name: 'Youtube', icon: <Youtube className="tw-w-6 tw-h-6" /> },
    { name: 'Twitch', icon: <Twitch className="tw-w-6 tw-h-6" /> },
    { name: 'TikTok', icon: <TiktokLogo className="tw-w-6 tw-h-6" /> },
    { name: 'LinkedIn', icon: <Linkedin className="tw-w-6 tw-h-6" /> },
    { name: 'Dribbble', icon: <DribbbleLogo className="tw-w-6 tw-h-6" /> }
  ];

  // Double the platforms for smoother infinite loop
  const allPlatforms = [...socialPlatforms, ...socialPlatforms];

  return (
    <div className="tw-relative tw-w-full tw-py-4 tw-overflow-hidden">
      <div className="tw-relative tw-w-full">
        {/* Upper gradient mask */}
        {/* <div className="tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-h-8 tw-bg-gradient-to-b tw-from-white tw-to-transparent tw-z-10"></div> */}
        
        {/* Lower gradient mask */}
        {/* <div className="tw-absolute tw-bottom-0 tw-left-0 tw-right-0 tw-h-8 tw-bg-gradient-to-t tw-from-white tw-to-transparent tw-z-10"></div> */}
        
        {/* Carousel Container */}
        <div className="tw-inline-flex tw-animate-carousel">
          {allPlatforms.map((platform, index) => (
            <div 
              key={`${platform.name}-${index}`} 
              className="tw-flex tw-flex-col tw-items-center tw-justify-center tw-mx-8"
            >
              <div className="tw-w-12 tw-h-12 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-white tw-shadow-md tw-border tw-border-gray-100">
                {platform.icon}
              </div>
              <span className="tw-text-xs tw-text-gray-600 tw-mt-2">{platform.name}</span>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default LogoCarousel;
