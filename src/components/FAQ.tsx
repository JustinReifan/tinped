
import React from 'react';
import { cn } from '@/lib/utils';
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";
import { ChevronDown } from 'lucide-react';

// FAQ data
const faqItems = [
  {
    question: "What is SMM and how does it work?",
    answer: "Social Media Marketing (SMM) involves promoting your content or brand through social media platforms. TINPED SMM provides services like followers, likes, views, and comments to boost your social media presence and increase engagement on your profiles."
  },
  {
    question: "How fast will I receive my order?",
    answer: "Delivery times vary based on the service and order size. Most orders begin processing instantly, with small orders completing within minutes to a few hours. Larger orders may take 24-48 hours to complete. You can always check your order status in real-time through your dashboard."
  },
  {
    question: "Are the followers/likes/views real?",
    answer: "We provide high-quality engagement that looks natural and authentic. While we use various methods to deliver services, we prioritize quality to ensure your profiles remain safe and the engagement appears organic."
  },
  {
    question: "Will I get banned for using your services?",
    answer: "No, our services are designed to be safe for your accounts. We deliver engagement at a natural pace and follow platform guidelines to minimize any risks. We've served over 56,000 customers without issues."
  },
  {
    question: "What payment methods do you accept?",
    answer: "We accept a wide variety of payment methods including credit/debit cards (Visa, Mastercard), digital wallets (PayPal, Google Pay, Apple Pay), bank transfers, and cryptocurrencies (Bitcoin, Ethereum)."
  },
  {
    question: "What happens if I don't receive my order?",
    answer: "In the rare case that your order isn't delivered within the expected timeframe, please contact our 24/7 support team. We offer a 100% money-back guarantee if we cannot deliver your order as promised."
  },
  {
    question: "Do you offer refills if followers drop?",
    answer: "Yes, we offer a 30-day auto-refill guarantee for most of our services. If you experience any drops in engagement within 30 days of delivery, our system will automatically refill your order at no additional cost."
  },
  {
    question: "How do I contact customer support?",
    answer: "Our customer support team is available 24/7 through live chat on our website, email support, and ticketing system. We typically respond within minutes during business hours and within a few hours during off-hours."
  }
];

const FAQ = () => {
  return (
    <section className="tw-w-full tw-py-20 tw-px-6 lg:tw-px-12 tw-relative tw-overflow-hidden tw-bg-gray-50/80">
      {/* Background Elements */}
      <div className="tw-absolute tw-inset-0 tw-bg-grid tw-bg-[size:40px_40px] tw-opacity-30 tw-z-0"></div>
      <div className="tw-absolute tw-top-40 -tw-left-20 tw-w-60 tw-h-60 tw-bg-primary-100 tw-rounded-full tw-filter tw-blur-[100px] tw-opacity-40 tw-animate-float"></div>
      
      <div className="tw-max-w-7xl tw-mx-auto tw-relative tw-z-10">
        <div className="tw-flex tw-flex-col tw-items-center tw-mb-14">
          {/* Section Badge */}
          <div className="tw-bg-primary tw-bg-opacity-10 tw-backdrop-blur-sm tw-rounded-full tw-px-4 tw-py-1.5 tw-flex tw-items-center tw-justify-center tw-mb-4 tw-border tw-border-primary-200">
            <span className="tw-text-primary tw-font-semibold tw-text-sm">Unlocking Answers →</span>
          </div>
          
          {/* Heading */}
          <h2 className="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-center tw-text-gray-900 tw-mb-4">
            Your Top <span className="text-gradient">Questions</span> Answered
          </h2>
          
          {/* Subheading */}
          <p className="tw-text-lg tw-text-gray-600 tw-text-center tw-max-w-2xl">
            Everything you need to know about TINPED SMM services
          </p>
        </div>
        
        {/* FAQ Accordion - Now in a 2-column layout */}
        <div className="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
          {/* First column */}
          <div className="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-primary-100 tw-overflow-hidden tw-transition-all tw-duration-300">
            <Accordion type="single" collapsible className="tw-w-full">
              {faqItems.slice(0, Math.ceil(faqItems.length / 2)).map((item, index) => (
                <AccordionItem 
                  key={`left-${index}`} 
                  value={`left-item-${index}`}
                  className="tw-border-primary-100 tw-overflow-hidden hover:tw-bg-primary-50/30 tw-transition-colors tw-duration-300"
                >
                  <AccordionTrigger className="tw-px-6 tw-py-5 tw-text-left tw-hover:no-underline tw-text-gray-800 tw-font-semibold tw-group">
                    <span className="tw-group-hover:tw-text-primary tw-transition-colors tw-duration-300">{item.question}</span>
                  </AccordionTrigger>
                  <AccordionContent className="tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                    {item.answer}
                  </AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </div>
          
          {/* Second column */}
          <div className="tw-bg-white tw-rounded-xl tw-shadow-lg hover:tw-shadow-glow-primary tw-border tw-border-primary-100 tw-overflow-hidden tw-transition-all tw-duration-300">
            <Accordion type="single" collapsible className="tw-w-full">
              {faqItems.slice(Math.ceil(faqItems.length / 2)).map((item, index) => (
                <AccordionItem 
                  key={`right-${index}`} 
                  value={`right-item-${index}`}
                  className="tw-border-primary-100 tw-overflow-hidden hover:tw-bg-primary-50/30 tw-transition-colors tw-duration-300"
                >
                  <AccordionTrigger className="tw-px-6 tw-py-5 tw-text-left tw-hover:no-underline tw-text-gray-800 tw-font-semibold tw-group">
                    <span className="tw-group-hover:tw-text-primary tw-transition-colors tw-duration-300">{item.question}</span>
                  </AccordionTrigger>
                  <AccordionContent className="tw-px-6 tw-pb-5 tw-text-gray-600 tw-font-light">
                    {item.answer}
                  </AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </div>
        </div>
      </div>
    </section>
  );
};

export default FAQ;
