<?php

declare(strict_types=1);

namespace Leevel\Flow;

/**
 * 流程控制复用.
 *
 * - 灵感来源于做禅道二次开发，里面有这样的用法
 */
trait FlowControl
{
    /**
     * 逻辑代码是否处于条件表达式中.
    */
    protected bool $inFlowControl = false;

    /**
     * 条件表达式是否为真.
    */
    protected bool $isFlowControlTrue = false;

    /**
     * 条件语句 if.
     */
    public function if(mixed $value = false): self
    {
        return $this->setFlowControl(true, $value ? true : false);
    }

    /**
     * 条件语句 elif.
     */
    public function elif(mixed $value = false): self
    {
        return $this->setFlowControl(true, $value ? true : false);
    }

    /**
     * 条件语句 else.
     */
    public function else(): self
    {
        return $this->setFlowControl(true, !$this->isFlowControlTrue);
    }

    /**
     * 条件语句 fi.
     */
    public function fi(): self
    {
        return $this->setFlowControl(false, false);
    }

    /**
     * 设置当前条件表达式状态.
     */
    public function setFlowControl(bool $inFlowControl, bool $isFlowControlTrue): self
    {
        $this->inFlowControl = $inFlowControl;
        $this->isFlowControlTrue = $isFlowControlTrue;

        return $this;
    }

    /**
     * 验证一下条件表达式是否通过.
     */
    public function checkFlowControl(): bool
    {
        return $this->inFlowControl && !$this->isFlowControlTrue;
    }
}
