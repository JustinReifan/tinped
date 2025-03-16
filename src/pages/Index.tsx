
import React from 'react';
import Navbar from '../components/Navbar';
import Hero from '../components/Hero';
import WhatIsTinped from '../components/WhatIsTinped';
import GetStarted from '../components/GetStarted';
import PriceList from '../components/PriceList';
import Features from '../components/Features';
import DifferenceSection from '../components/DifferenceSection';
import Testimonials from '../components/Testimonials';
import PaymentMethods from '../components/PaymentMethods';
import FAQ from '../components/FAQ';
import Footer from '../components/Footer';

const Index = () => {
  return (
    <main className="tw-min-h-screen tw-bg-white tw-overflow-x-hidden">
      <Navbar />
      <Hero />
      <WhatIsTinped />
      <GetStarted />
      <PriceList />
      <Features />
      <DifferenceSection />
      <Testimonials />
      <PaymentMethods />
      <FAQ />
      <Footer />
    </main>
  );
};

export default Index;
