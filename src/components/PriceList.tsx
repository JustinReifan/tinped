
import React from 'react';
import { cn } from '@/lib/utils';
import { Facebook, Instagram, Twitter, Youtube, TwitchIcon, Twitch, Music, Globe } from 'lucide-react';

// Service data
const services = [
  {
    id: 1,
    name: "Facebook",
    icon: <Facebook className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 5,000'
  },
  {
    id: 2,
    name: "Instagram",
    icon: <Instagram className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 8,000'
  },
  {
    id: 3,
    name: "Twitter",
    icon: <Twitter className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 10,000'
  },
  {
    id: 4,
    name: "YouTube",
    icon: <Youtube className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 15,000'
  },
  {
    id: 5,
    name: "Twitch",
    icon: <Twitch className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 12,000'
  },
  {
    id: 6,
    name: "TikTok",
    icon: <Music className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 9,000'
  },
  {
    id: 7,
    name: "Website",
    icon: <Globe className="tw-w-6 tw-h-6" />,
    startingPrice: 'Rp. 20,000'
  }
];

const PriceCard = ({ service }) => {
  return (
    <div className="tw-flex tw-flex-row tw-items-center tw-bg-white tw-rounded-xl tw-p-4 tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-100 hover:tw-border-primary-300 tw-transition-all tw-duration-300 tw-w-[250px] sm:tw-w-[280px]">
      {/* Left Side - Service Info */}
      <div className="tw-flex tw-items-center tw-space-x-3 tw-flex-1">
        {/* Icon with background */}
        <div className="tw-w-12 tw-h-12 tw-flex tw-items-center tw-justify-center tw-rounded-full tw-bg-primary-100">
          <span className="tw-text-primary-600">
            {service.icon}
          </span>
        </div>
        
        {/* Service Name */}
        <div>
          <h3 className="tw-font-semibold tw-text-gray-900">{service.name}</h3>
          <p className="tw-text-sm tw-text-gray-500">Services</p>
        </div>
      </div>
      
      {/* Right Side - Price */}
      <div className="tw-text-right">
        <p className="tw-text-xs tw-text-gray-500">Starting from</p>
        <p className="tw-font-bold tw-text-primary">{service.startingPrice}</p>
      </div>
    </div>
  );
};

const PriceList = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden">
      {/* Background Elements */}
      <div className="tw-absolute tw-bottom-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-40 tw-animate-float" style={{ animationDelay: '0.5s' }}></div>
      
      <div className="tw-max-w-7xl tw-mx-auto">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Price List</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Where <span className="text-gradient">Quality</span> Meets Your Budget
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Explore our competitive prices for premium SMM services across all major platforms
          </p>
        </div>
        
        {/* Carousel */}
        <div className="tw-relative tw-w-full tw-overflow-hidden">
          <div className="tw-flex tw-gap-6 tw-py-4 tw-animate-carousel">
            {services.concat(services).map((service, index) => (
              <PriceCard key={`${service.id}-${index}`} service={service} />
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default PriceList;
