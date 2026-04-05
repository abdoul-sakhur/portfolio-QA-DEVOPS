#!/bin/bash
# ============================================================
# Oracle Cloud Free Tier — Setup script for Portfolio QA DevOps
# Run this on your Oracle VM after SSH connection
# Usage: chmod +x setup-oracle.sh && sudo ./setup-oracle.sh
# ============================================================
set -e

echo "══════════════════════════════════════════════════"
echo "  Portfolio QA DevOps — Oracle Cloud Setup"
echo "══════════════════════════════════════════════════"

# ── 1. Update system ─────────────────────────────────────────
echo "[1/5] Updating system..."
apt-get update && apt-get upgrade -y

# ── 2. Install Docker ────────────────────────────────────────
echo "[2/5] Installing Docker..."
if ! command -v docker &> /dev/null; then
    curl -fsSL https://get.docker.com | sh
    systemctl enable docker
    systemctl start docker
    usermod -aG docker ubuntu
    echo "  ✓ Docker installed"
else
    echo "  ✓ Docker already installed"
fi

# ── 3. Install Docker Compose ────────────────────────────────
echo "[3/5] Installing Docker Compose..."
if ! command -v docker compose &> /dev/null; then
    apt-get install -y docker-compose-plugin
    echo "  ✓ Docker Compose installed"
else
    echo "  ✓ Docker Compose already installed"
fi

# ── 4. Open firewall ports ───────────────────────────────────
echo "[4/5] Configuring firewall..."
iptables -I INPUT 6 -m state --state NEW -p tcp --dport 80 -j ACCEPT
iptables -I INPUT 6 -m state --state NEW -p tcp --dport 443 -j ACCEPT
netfilter-persistent save 2>/dev/null || iptables-save > /etc/iptables/rules.v4
echo "  ✓ Ports 80 and 443 opened"

# ── 5. Clone and deploy ─────────────────────────────────────
echo "[5/5] Ready to deploy!"
echo ""
echo "══════════════════════════════════════════════════"
echo "  Next steps:"
echo "══════════════════════════════════════════════════"
echo ""
echo "  1. Clone your repo:"
echo "     git clone https://github.com/YOUR_USER/portfolio-QA-DEVOPS.git"
echo "     cd portfolio-QA-DEVOPS"
echo ""
echo "  2. Deploy:"
echo "     docker compose -f docker-compose.oracle.yml up -d --build"
echo ""
echo "  3. Access your site at:"
echo "     http://YOUR_VM_PUBLIC_IP"
echo ""
echo "══════════════════════════════════════════════════"
