
import React, { useState, useEffect } from 'react';
import { Menu, X, Search, Home, BarChart2, Calculator } from 'lucide-react';
import { cn } from '@/lib/utils';

const Navbar = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  return (
    <header className={cn(
      'tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-transition-all tw-duration-300 tw-py-4 tw-px-6 lg:tw-px-12',
      isScrolled ? 'glass-morphism tw-shadow-md' : 'tw-bg-transparent'
    )}>
      <div className="tw-max-w-7xl tw-mx-auto">
        <nav className="tw-flex tw-items-center tw-justify-between">
          {/* Logo */}
          <div className="tw-flex tw-items-center">
            <a href="/" className="tw-flex tw-items-center tw-space-x-2">
              <div className="tw-relative tw-h-8 tw-w-8 tw-overflow-hidden">
                <div className="tw-absolute tw-inset-0 tw-bg-primary tw-rounded-lg tw-animate-pulse-glow"></div>
                <div className="tw-absolute tw-inset-0.5 tw-bg-white tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                  <span className="tw-font-bold tw-text-primary tw-text-xs">TINPED</span>
                </div>
              </div>
              <span className="tw-font-bold tw-text-gray-800 tw-hidden sm:tw-block">TINPED <span className="tw-text-primary">SMM</span></span>
            </a>
          </div>

          {/* Desktop Navigation */}
          <div className="tw-hidden md:tw-flex tw-items-center tw-space-x-8">
            <a href="#" className="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
              <Home className="tw-w-4 tw-h-4" />
              <span>Beranda</span>
            </a>
            <a href="#" className="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
              <Search className="tw-w-4 tw-h-4" />
              <span>Cek Transaksi</span>
            </a>
            <a href="#" className="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
              <BarChart2 className="tw-w-4 tw-h-4" />
              <span>Leaderboard</span>
            </a>
            <a href="#" className="tw-flex tw-items-center tw-space-x-1 tw-text-gray-700 hover:tw-text-primary tw-transition-colors link-underline">
              <Calculator className="tw-w-4 tw-h-4" />
              <span>Kalkulator</span>
            </a>
          </div>

          {/* Action Buttons */}
          <div className="tw-hidden md:tw-flex tw-items-center tw-space-x-3">
            <button className="btn-outline tw-text-sm">
              Masuk
            </button>
            <button className="btn-primary tw-text-sm tw-flex tw-items-center tw-space-x-1 btn-glow">
              <span>Daftar</span>
            </button>
          </div>

          {/* Mobile Menu Button */}
          <button 
            className="tw-block md:tw-hidden tw-text-gray-700 hover:tw-text-primary tw-transition-colors" 
            onClick={toggleMenu}
          >
            {isMenuOpen ? <X className="tw-w-6 tw-h-6" /> : <Menu className="tw-w-6 tw-h-6" />}
          </button>
        </nav>
      </div>

      {/* Mobile Menu */}
      <div className={cn(
        'tw-fixed tw-inset-0 tw-z-40 tw-bg-white tw-pt-20 tw-px-6 tw-transform tw-transition-all tw-duration-300 tw-ease-in-out md:tw-hidden',
        isMenuOpen ? 'tw-translate-x-0' : 'tw-translate-x-full'
      )}>
        <div className="tw-flex tw-flex-col tw-space-y-6">
          <a href="#" className="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
            <Home className="tw-w-5 tw-h-5" />
            <span className="tw-font-medium">Beranda</span>
          </a>
          <a href="#" className="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
            <Search className="tw-w-5 tw-h-5" />
            <span className="tw-font-medium">Cek Transaksi</span>
          </a>
          <a href="#" className="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
            <BarChart2 className="tw-w-5 tw-h-5" />
            <span className="tw-font-medium">Leaderboard</span>
          </a>
          <a href="#" className="tw-flex tw-items-center tw-space-x-3 tw-text-gray-700 hover:tw-text-primary tw-transition-colors tw-py-3 tw-border-b tw-border-gray-100">
            <Calculator className="tw-w-5 tw-h-5" />
            <span className="tw-font-medium">Kalkulator</span>
          </a>
          
          <div className="tw-flex tw-flex-col tw-space-y-3 tw-pt-4">
            <button className="btn-outline tw-w-full">
              Masuk
            </button>
            <button className="btn-primary tw-w-full btn-glow">
              Daftar
            </button>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Navbar;
