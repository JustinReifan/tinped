
import React from 'react';
import { cn } from '@/lib/utils';
import { Zap, ShieldCheck, Clock, HeadsetIcon } from 'lucide-react';

// Feature data
const features = [
  {
    id: 1,
    title: "Pengiriman Cepat",
    description: "Pesanan diproses instan dan dikirim dalam hitungan menit hingga jam, sesuai ukuran pesanan.",
    icon: <Zap className="tw-w-6 tw-h-6 tw-text-primary-500" />
  },
  {
    id: 2,
    title: "Kualitas Terjamin",
    description: "Layanan kami memberikan engagement berkualitas tinggi dan terlihat alami untuk profil Anda.",
    icon: <ShieldCheck className="tw-w-6 tw-h-6 tw-text-primary-500" />
  },
  {
    id: 3,
    title: "Customer Support 24/7",
    description: "Tim kami siap membantu Anda kapan pun, menjamin pengalaman lancar dan solusi cepat setiap saat.",
    icon: <HeadsetIcon className="tw-w-6 tw-h-6 tw-text-primary-500" />
  },
  {
    id: 4,
    title: "Refill Layanan",
    description: "Kami memberikan refill gratis hingga seumur hidup untuk pesanan yang mengalami penurunan/drop.",
    icon: <Clock className="tw-w-6 tw-h-6 tw-text-primary-500" />
  }
];

const FeatureCard = ({ feature }) => {
  return (
    <div className="tw-group tw-relative tw-overflow-hidden">
      {/* Inner glow effect */}
      <div className="tw-absolute tw-inset-0 tw-bg-gradient-to-br tw-from-primary-100/50 tw-via-primary-50/30 tw-to-transparent tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-duration-500 tw-rounded-xl"></div>
      
      {/* Card content */}
      <div className="tw-bg-white tw-p-6 tw-rounded-xl tw-shadow-sm group-hover:tw-shadow-glow-primary tw-border tw-border-primary-50 group-hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-relative tw-z-10">
        <div className="tw-w-12 tw-h-12 tw-rounded-full tw-bg-primary-100 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-relative tw-z-10">
          {feature.icon}
        </div>
        <h3 className="tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2 tw-relative tw-z-10">{feature.title}</h3>
        <p className="tw-text-gray-600 tw-relative tw-z-10">{feature.description}</p>
      </div>
    </div>
  );
};

const Features = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
      {/* Background Elements */}
      <div className="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
      <div className="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
      
      <div className="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Features</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Kenapa  <span className="text-gradient">TINPED SMM?</span>
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Solusi terbaik - kami hadir untuk memberikan layanan berkualitas tinggi yang memenuhi setiap kebutuhan media sosial Anda.
          </p>
        </div>
        
        {/* Dashboard Screenshot with enhanced glow */}
        <div className="tw-mb-16 tw-flex tw-justify-center">
          <div className="tw-relative tw-group">
            {/* Screenshot with mask */}
            <div className="tw-relative tw-z-10 tw-bg-white tw-rounded-xl tw-overflow-hidden tw-shadow-lg tw-border tw-border-primary-200 tw-max-w-4xl tw-transition-all tw-duration-300 group-hover:tw-shadow-lg">
              <div className="tw-h-8 tw-bg-gray-100 tw-border-b tw-border-gray-200 tw-flex tw-items-center tw-px-4">
                <div className="tw-flex tw-space-x-2">
                  <div className="tw-w-3 tw-h-3 tw-rounded-full tw-bg-red-400"></div>
                  <div className="tw-w-3 tw-h-3 tw-rounded-full tw-bg-yellow-400"></div>
                  <div className="tw-w-3 tw-h-3 tw-rounded-full tw-bg-green-400"></div>
                </div>
              </div>
              <div className="tw-bg-gradient-to-br tw-from-gray-100 tw-to-white tw-p-4 tw-min-h-[300px] sm:tw-min-h-[400px] tw-flex tw-flex-col">
                {/* Header */}
                <div className="tw-px-4 tw-py-3 tw-bg-primary tw-text-white tw-rounded-lg tw-flex tw-justify-between tw-items-center tw-mb-4">
                  <div className="tw-font-medium">Dashboard</div>
                  <div className="tw-text-sm tw-bg-white/20 tw-py-1 tw-px-3 tw-rounded-full">Balance: Rp. 250,000</div>
                </div>
                
                {/* Content */}
                <div className="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4 tw-mb-4">
                  <div className="tw-bg-white tw-rounded-lg tw-p-4 tw-border tw-border-gray-200 tw-shadow-sm">
                    <div className="tw-text-sm tw-text-gray-500">Total Orders</div>
                    <div className="tw-text-2xl tw-font-bold tw-text-gray-900">532</div>
                  </div>
                  <div className="tw-bg-white tw-rounded-lg tw-p-4 tw-border tw-border-gray-200 tw-shadow-sm">
                    <div className="tw-text-sm tw-text-gray-500">Active Orders</div>
                    <div className="tw-text-2xl tw-font-bold tw-text-gray-900">8</div>
                  </div>
                  <div className="tw-bg-white tw-rounded-lg tw-p-4 tw-border tw-border-gray-200 tw-shadow-sm">
                    <div className="tw-text-sm tw-text-gray-500">Completed</div>
                    <div className="tw-text-2xl tw-font-bold tw-text-gray-900">524</div>
                  </div>
                </div>
                
                {/* Table header */}
                <div className="tw-bg-gray-50 tw-rounded-t-lg tw-border tw-border-gray-200 tw-p-3 tw-grid tw-grid-cols-4 tw-font-medium tw-text-gray-700">
                  <div>Service</div>
                  <div>Order ID</div>
                  <div>Status</div>
                  <div>Amount</div>
                </div>
                
                {/* Table rows */}
                <div className="tw-bg-white tw-rounded-b-lg tw-border-x tw-border-b tw-border-gray-200">
                  <div className="tw-p-3 tw-grid tw-grid-cols-4 tw-border-b tw-border-gray-100 tw-text-sm">
                    <div>Instagram Followers</div>
                    <div>TIN-12345</div>
                    <div><span className="tw-text-green-500 tw-bg-green-50 tw-px-2 tw-py-0.5 tw-rounded-full">Completed</span></div>
                    <div>Rp. 50,000</div>
                  </div>
                  <div className="tw-p-3 tw-grid tw-grid-cols-4 tw-border-b tw-border-gray-100 tw-text-sm">
                    <div>Facebook Likes</div>
                    <div>TIN-12346</div>
                    <div><span className="tw-text-blue-500 tw-bg-blue-50 tw-px-2 tw-py-0.5 tw-rounded-full">Processing</span></div>
                    <div>Rp. 35,000</div>
                  </div>
                  <div className="tw-p-3 tw-grid tw-grid-cols-4 tw-text-sm">
                    <div>YouTube Views</div>
                    <div>TIN-12347</div>
                    <div><span className="tw-text-yellow-500 tw-bg-yellow-50 tw-px-2 tw-py-0.5 tw-rounded-full">Pending</span></div>
                    <div>Rp. 75,000</div>
                  </div>
                </div>
              </div>
            </div>
            
            {/* Enhanced glow effect behind screenshot */}
            <div className="tw-absolute tw-inset-0 tw-bg-primary-300 tw-rounded-xl tw-blur-[40px] tw-opacity-20 group-hover:tw-opacity-40 tw-z-0 tw-animate-pulse-glow tw-transition-opacity "></div>
          </div>
        </div>
        
        {/* Features Grid */}
        <div className="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-2 tw-gap-6">
          {features.map(feature => (
            <FeatureCard key={feature.id} feature={feature} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Features;
