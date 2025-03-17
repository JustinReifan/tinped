
import React from 'react';
import { cn } from '@/lib/utils';
import { Star } from 'lucide-react';

// Testimonial data
const testimonials = [
  {
    id: 1,
    text: "TINPED SMM has truly revolutionized my social media marketing strategy. The followers I gained are real and engaged with my content!",
    name: "Sarah Johnson",
    role: "Digital Marketer",
    image: "https://randomuser.me/api/portraits/women/1.jpg"
  },
  {
    id: 2,
    text: "I've tried many SMM panels before, but TINPED stands out with its quality and customer service. My YouTube channel grew exponentially!",
    name: "Michael Chen",
    role: "Content Creator",
    image: "https://randomuser.me/api/portraits/men/2.jpg"
  },
  {
    id: 3,
    text: "As a small business owner, I needed affordable yet effective social media solutions. TINPED SMM delivered beyond my expectations.",
    name: "Jessica Williams",
    role: "Boutique Owner",
    image: "https://randomuser.me/api/portraits/women/3.jpg"
  },
  {
    id: 4,
    text: "The speed of delivery is incredible. I placed an order and saw results within minutes. Will definitely use their services again!",
    name: "David Rodriguez",
    role: "Musician",
    image: "https://randomuser.me/api/portraits/men/4.jpg"
  },
  {
    id: 5,
    text: "TINPED SMM helped me grow my Instagram following by 10K in just one month. The engagement is fantastic and looks completely natural.",
    name: "Emma Thompson",
    role: "Lifestyle Influencer",
    image: "https://randomuser.me/api/portraits/women/5.jpg"
  },
  {
    id: 6,
    text: "Their customer support is exceptional. Any questions I had were answered promptly. A truly reliable service for growing your social presence.",
    name: "James Wilson",
    role: "Startup Founder",
    image: "https://randomuser.me/api/portraits/men/6.jpg"
  }
];

const TestimonialCard = ({ testimonial }) => {
  return (
    <div className="tw-bg-white tw-p-6 tw-rounded-xl tw-shadow-sm hover:tw-shadow-glow-primary tw-border tw-border-primary-50 hover:tw-border-primary-200 tw-transition-all tw-duration-300 tw-flex tw-flex-col">
      {/* Stars */}
      <div className="tw-flex tw-space-x-1 tw-mb-4">
        {[...Array(5)].map((_, i) => (
          <Star key={i} className="tw-w-4 tw-h-4 tw-fill-primary tw-text-primary" />
        ))}
      </div>
      
      {/* Testimonial Text */}
      <p className="tw-text-gray-700 tw-mb-6 tw-flex-1">{testimonial.text}</p>
      
      {/* Customer Info */}
      <div className="tw-flex tw-items-center">
        <div className="tw-w-10 tw-h-10 tw-rounded-full tw-overflow-hidden tw-mr-3">
          <img 
            src={testimonial.image} 
            alt={testimonial.name}
            className="tw-w-full tw-h-full tw-object-cover"
          />
        </div>
        <div>
          <h4 className="tw-font-semibold tw-text-gray-900">{testimonial.name}</h4>
          <p className="tw-text-sm tw-text-gray-500">{testimonial.role}</p>
        </div>
      </div>
    </div>
  );
};

const Testimonials = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
      {/* Background Elements */}
      <div className="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
      <div className="tw-absolute tw-top-40 -tw-right-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-50 tw-animate-float"></div>
      
      <div className="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Testimonials</span>
          </div>

          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            See what our <span className="text-gradient">56k+ Customers</span> have to say about us
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Real stories from real customers who have transformed their social media presence
          </p>
        </div>
        
        {/* Testimonials Grid */}
        <div className="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
          {testimonials.map(testimonial => (
            <TestimonialCard key={testimonial.id} testimonial={testimonial} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Testimonials;
